<?php

declare(strict_types=1);

use App\Models\Book;
use Database\Factories\AuthorFactory;
use Database\Factories\GenreFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('should create books via v1 API', function () {
    expect(Book::count())->toBe(0);

    $author = AuthorFactory::new()->create();
    $genre = GenreFactory::new()->create();

    $payload = [
        'author_id' => $author->id,
        'genre_id' => $genre->id,
        'isbn' => fake()->isbn13(),
        'title' => 'Project Hail Mary',
        'synopsis' => 'A lone astronaut must save humanity from an extinction-level threat.',
        'cover_url' => 'https://example.com/covers/project-hail-mary.jpg',
        'show_full_synopsis' => true,
    ];

    $this->postJson(route('api.v1.books.store'), $payload)
        ->assertStatus(200)
        ->assertJsonFragment(['isbn' => $payload['isbn']])
        ->assertJsonFragment(['title' => $payload['title']])
        ->assertJsonFragment(['synopsis' => $payload['synopsis']])
        ->assertJsonFragment(['cover_url' => $payload['cover_url']]);

    expect(Book::count())->toBe(1);
});

it('should list books via v1 API', function () {
    $books = Book::factory()->count(3)->create();

    $this->getJson(route('api.v1.books.index'))
        ->assertStatus(200)
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'isbn', 'title', 'cover_url', 'synopsis', 'created_at', 'updated_at'],
            ],
        ])
        ->assertJsonFragment(['id' => $books[0]->id])
        ->assertJsonFragment(['id' => $books[1]->id])
        ->assertJsonFragment(['id' => $books[2]->id]);
});

it('should paginate books via v1 API', function () {
    $books = Book::factory()->count(3)->create();
    expect(Book::count())->toBe(3);

    $this->getJson(route('api.v1.books.index', ['page' => 1, 'count' => 2]))
        ->assertStatus(200)
        ->assertJsonCount(2, 'data')
        ->assertJsonFragment(['id' => $books[0]->id])
        ->assertJsonFragment(['id' => $books[1]->id])
        ->assertJsonMissing(['id' => $books[2]->id]);

    $this->getJson(route('api.v1.books.index', ['page' => 2, 'count' => 2]))
        ->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonMissing(['id' => $books[0]->id])
        ->assertJsonMissing(['id' => $books[1]->id])
        ->assertJsonFragment(['id' => $books[2]->id]);
});

it('should filter books with search filter via v1 API', function () {
    $theMartian = Book::factory()->create(['title' => 'The Martian']);
    $projectHailMary = Book::factory()->create(['title' => 'Project Hail Mary']);
    expect(Book::count())->toBe(2);

    $this->getJson(route('api.v1.books.index', ['search' => 'martian']))
        ->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonFragment(['id' => $theMartian->id])
        ->assertJsonMissing(['id' => $projectHailMary->id]);

    $this->getJson(route('api.v1.books.index', ['search' => 'mary']))
        ->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonMissing(['id' => $theMartian->id])
        ->assertJsonFragment(['id' => $projectHailMary->id]);
});

it('should filter books with author_id filter via v1 API', function () {
    $weir = AuthorFactory::new()->create(['name' => 'Andy Weir']);
    $tolkin = AuthorFactory::new()->create(['name' => 'J.R.R. Tolkin']);
    $theMartian = Book::factory()->create(['title' => 'The Martian', 'author_id' => $weir->id]);
    $projectHailMary = Book::factory()->create(['title' => 'Project Hail Mary', 'author_id' => $weir->id]);
    $theHobbit = Book::factory()->create(['title' => 'The Hobbit', 'author_id' => $tolkin->id]);
    expect(Book::count())->toBe(3);

    $this->getJson(route('api.v1.books.index', ['author_id' => $weir->id]))
        ->assertStatus(200)
        ->assertJsonCount(2, 'data')
        ->assertJsonFragment(['id' => $theMartian->id])
        ->assertJsonFragment(['id' => $projectHailMary->id])
        ->assertJsonMissing(['id' => $theHobbit->id]);

    $this->getJson(route('api.v1.books.index', ['author_id' => $tolkin->id]))
        ->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonMissing(['id' => $theMartian->id])
        ->assertJsonMissing(['id' => $projectHailMary->id])
        ->assertJsonFragment(['id' => $theHobbit->id]);
});

it('should filter books with genre_id filter via v1 API', function () {
    $sciFi = GenreFactory::new()->create(['name' => 'Sci-Fi']);
    $fantasy = GenreFactory::new()->create(['name' => 'Fantasy']);
    $theMartian = Book::factory()->create(['title' => 'The Martian', 'genre_id' => $sciFi->id]);
    $projectHailMary = Book::factory()->create(['title' => 'Project Hail Mary', 'genre_id' => $sciFi->id]);
    $theHobbit = Book::factory()->create(['title' => 'The Hobbit', 'genre_id' => $fantasy->id]);
    expect(Book::count())->toBe(3);

    $this->getJson(route('api.v1.books.index', ['genre_id' => $sciFi->id]))
        ->assertStatus(200)
        ->assertJsonCount(2, 'data')
        ->assertJsonFragment(['id' => $theMartian->id])
        ->assertJsonFragment(['id' => $projectHailMary->id])
        ->assertJsonMissing(['id' => $theHobbit->id]);

    $this->getJson(route('api.v1.books.index', ['genre_id' => $fantasy->id]))
        ->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonMissing(['id' => $theMartian->id])
        ->assertJsonMissing(['id' => $projectHailMary->id])
        ->assertJsonFragment(['id' => $theHobbit->id]);
});


it('should filter books with author_id and genre_id filter via v1 API', function () {
    $rowling = AuthorFactory::new()->create(['name' => 'J.K. Rowling']);
    $conanDoyle = AuthorFactory::new()->create(['name' => 'Arthur Conan Doyle']);

    $fantasy = GenreFactory::new()->create(['name' => 'Fantasy']);
    $detective = GenreFactory::new()->create(['name' => 'Detective']);

    $harryPotter = Book::factory()->create(['title' => 'Harry Potter', 'author_id' => $rowling->id, 'genre_id' => $fantasy->id]);
    $theCuckoo = Book::factory()->create(['title' => 'The Cuckoo\'s Calling', 'author_id' => $rowling->id, 'genre_id' => $detective->id]);
    $sherlockHolmes = Book::factory()->create(['title' => 'Sherlock Holmes', 'author_id' => $conanDoyle->id, 'genre_id' => $detective->id]);
    $theLostWorld = Book::factory()->create(['title' => 'The Lost World', 'author_id' => $conanDoyle->id, 'genre_id' => $fantasy->id]);
    expect(Book::count())->toBe(4);

    $this->getJson(route('api.v1.books.index', ['author_id' => $rowling->id, 'genre_id' => $fantasy->id]))
        ->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonFragment(['id' => $harryPotter->id]);

    $this->getJson(route('api.v1.books.index', ['author_id' => $rowling->id, 'genre_id' => $detective->id]))
        ->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonFragment(['id' => $theCuckoo->id]);

    $this->getJson(route('api.v1.books.index', ['author_id' => $conanDoyle->id, 'genre_id' => $fantasy->id]))
        ->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonFragment(['id' => $theLostWorld->id]);

    $this->getJson(route('api.v1.books.index', ['author_id' => $conanDoyle->id, 'genre_id' => $detective->id]))
        ->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonFragment(['id' => $sherlockHolmes->id]);
});

it('should sort books via v1 API', function () {
    $theMartian = Book::factory()->create(['title' => 'The Martian']);
    $projectHailMary = Book::factory()->create(['title' => 'Project Hail Mary']);

    $response = $this->getJson(route('api.v1.books.index', ['order_by' => 'title']))
        ->assertStatus(200)
        ->assertJsonCount(2, 'data')
        ->getOriginalContent();

    expect($response->data[0]->id)->toBe($projectHailMary->id)
        ->and($response->data[1]->id)->toBe($theMartian->id);

    $response = $this->getJson(route('api.v1.books.index', ['order_by' => '-title']))
        ->assertStatus(200)
        ->assertJsonCount(2, 'data')
        ->getOriginalContent();

    expect($response->data[0]->id)->toBe($theMartian->id)
        ->and($response->data[1]->id)->toBe($projectHailMary->id);
});

it('should include author and genre relationships via v1 API', function () {
    $weir = AuthorFactory::new()->create(['name' => 'Andy Weir']);
    $sciFi = GenreFactory::new()->create(['name' => 'Sci-Fi']);

    Book::factory()->create(['title' => 'The Martian', 'author_id' => $weir->id, 'genre_id' => $sciFi->id]);

    $response = $this->getJson(route('api.v1.books.index', ['with' => 'author,genre']))
        ->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->getOriginalContent();

    expect($response->data[0]->author->data->id)->toBe($weir->id)
        ->and($response->data[0]->genre->data->id)->toBe($sciFi->id);
});

it('should show books by ID via v1 API', function () {
    $theMartian = Book::factory()->create(['title' => 'The Martian']);
    expect(Book::count())->toBe(1);

    // Books are identified by ISBN, not by ID.
    $this->getJson(route('api.v1.books.show', ['book' => $theMartian->isbn]))
        ->assertStatus(200)
        ->assertJsonFragment(['id' => $theMartian->id]);
});

it('should include author and genre relationships when showing books by ID via v1 API', function () {
    $weir = AuthorFactory::new()->create(['name' => 'Andy Weir']);
    $sciFi = GenreFactory::new()->create(['name' => 'Sci-Fi']);

    $theMartian = Book::factory()->create(['title' => 'The Martian', 'author_id' => $weir->id, 'genre_id' => $sciFi->id]);
    expect(Book::count())->toBe(1);

    $response = $this->getJson(route('api.v1.books.show', ['book' => $theMartian->isbn, 'with' => 'author,genre']))
        ->assertStatus(200)
        ->getOriginalContent();

    expect($response->data->author->data->id)->toBe($weir->id)
        ->and($response->data->genre->data->id)->toBe($sciFi->id);
});
