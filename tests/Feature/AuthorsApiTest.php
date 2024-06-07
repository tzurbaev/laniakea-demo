<?php

declare(strict_types=1);

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('should create authors via v1 API', function () {
    expect(Author::count())->toBe(0);

    $payload = [
        'name' => 'Andy Weir',
        'photo_url' => 'https://example.com/andy-weir.jpg',
        'bio' => 'Andy Weir is an American novelist who is best known for his science fiction novel The Martian.',
    ];

    $this->postJson(route('api.v1.authors.store'), $payload)
        ->assertStatus(200)
        ->assertJsonFragment(['name' => $payload['name']])
        ->assertJsonFragment(['photo_url' => $payload['photo_url']])
        ->assertJsonFragment(['bio' => $payload['bio']]);

    expect(Author::count())->toBe(1);
});

it('should create authors via v2 API', function () {
    expect(Author::count())->toBe(0);

    $payload = [
        'full_name' => 'Andy Weir',
        'photo_url' => 'https://example.com/andy-weir.jpg',
        'country' => 'United States',
        'biography' => 'Andy Weir is an American novelist who is best known for his science fiction novel The Martian.',
    ];

    $this->postJson(route('api.v2.authors.store'), $payload)
        ->assertStatus(200)
        ->assertJsonFragment(['full_name' => $payload['full_name']])
        ->assertJsonFragment(['photo_url' => $payload['photo_url']])
        ->assertJsonFragment(['country' => $payload['country']])
        ->assertJsonFragment(['biography' => $payload['biography']]);

    expect(Author::count())->toBe(1);
});

it('should list authors via v1 API', function () {
    $authors = Author::factory()->count(3)->create();
    expect(Author::count())->toBe(3);

    $this->getJson(route('api.v1.authors.index'))
        ->assertStatus(200)
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'photo_url', 'bio', 'created_at', 'updated_at'],
            ],
        ])
        ->assertJsonFragment(['id' => $authors[0]->id])
        ->assertJsonFragment(['id' => $authors[1]->id])
        ->assertJsonFragment(['id' => $authors[2]->id]);
});

it('should list authors via v2 API', function () {
    $authors = Author::factory()->count(3)->create();
    expect(Author::count())->toBe(3);

    $this->getJson(route('api.v2.authors.index'))
        ->assertStatus(200)
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'full_name', 'country', 'biography', 'photo_url'],
            ],
        ])
        ->assertJsonFragment(['id' => $authors[0]->id])
        ->assertJsonFragment(['id' => $authors[1]->id])
        ->assertJsonFragment(['id' => $authors[2]->id]);
});

it('should paginate authors via v1 API', function () {
    $authors = Author::factory()->count(3)->create();
    expect(Author::count())->toBe(3);

    $this->getJson(route('api.v1.authors.index', ['page' => 1, 'count' => 2]))
        ->assertStatus(200)
        ->assertJsonCount(2, 'data')
        ->assertJsonFragment(['id' => $authors[0]->id])
        ->assertJsonFragment(['id' => $authors[1]->id])
        ->assertJsonMissing(['id' => $authors[2]->id]);

    $this->getJson(route('api.v1.authors.index', ['page' => 2, 'count' => 2]))
        ->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonMissing(['id' => $authors[0]->id])
        ->assertJsonMissing(['id' => $authors[1]->id])
        ->assertJsonFragment(['id' => $authors[2]->id]);
});

it('should paginate authors via v2 API', function () {
    $authors = Author::factory()->count(3)->create();
    expect(Author::count())->toBe(3);

    $this->getJson(route('api.v2.authors.index', ['page' => 1, 'count' => 2]))
        ->assertStatus(200)
        ->assertJsonCount(2, 'data')
        ->assertJsonFragment(['id' => $authors[0]->id])
        ->assertJsonFragment(['id' => $authors[1]->id])
        ->assertJsonMissing(['id' => $authors[2]->id]);

    $this->getJson(route('api.v2.authors.index', ['page' => 2, 'count' => 2]))
        ->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonMissing(['id' => $authors[0]->id])
        ->assertJsonMissing(['id' => $authors[1]->id])
        ->assertJsonFragment(['id' => $authors[2]->id]);
});

it('should filter authors with search filter via v1 API', function () {
    $weir = Author::factory()->create(['name' => 'Andy Weir']);
    $tolkien = Author::factory()->create(['name' => 'J.R.R. Tolkien']);
    expect(Author::count())->toBe(2);

    $this->getJson(route('api.v1.authors.index', ['search' => 'Andy']))
        ->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonFragment(['id' => $weir->id]);

    $this->getJson(route('api.v1.authors.index', ['search' => 'Tolkien']))
        ->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonFragment(['id' => $tolkien->id]);
});

it('should filter authors with search filter via v2 API', function () {
    $weir = Author::factory()->create(['name' => 'Andy Weir']);
    $tolkien = Author::factory()->create(['name' => 'J.R.R. Tolkien']);
    expect(Author::count())->toBe(2);

    $this->getJson(route('api.v2.authors.index', ['search' => 'Andy']))
        ->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonFragment(['id' => $weir->id]);

    $this->getJson(route('api.v2.authors.index', ['search' => 'Tolkien']))
        ->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonFragment(['id' => $tolkien->id]);
});

it('should sort authors via v1 API', function () {
    $weir = Author::factory()->create(['name' => 'Andy Weir']);
    $tolkien = Author::factory()->create(['name' => 'J.R.R. Tolkien']);
    expect(Author::count())->toBe(2);

    $response = $this->getJson(route('api.v1.authors.index', ['order_by' => 'name']))
        ->assertStatus(200)
        ->assertJsonCount(2, 'data')
        ->getOriginalContent();

    expect($response->data[0]->id)->toBe($weir->id)
        ->and($response->data[1]->id)->toBe($tolkien->id);

    $response = $this->getJson(route('api.v1.authors.index', ['order_by' => '-name']))
        ->assertStatus(200)
        ->assertJsonCount(2, 'data')
        ->getOriginalContent();

    expect($response->data[0]->id)->toBe($tolkien->id)
        ->and($response->data[1]->id)->toBe($weir->id);
});

it('should sort authors via v2 API', function () {
    $weir = Author::factory()->create(['name' => 'Andy Weir']);
    $tolkien = Author::factory()->create(['name' => 'J.R.R. Tolkien']);
    expect(Author::count())->toBe(2);

    $response = $this->getJson(route('api.v2.authors.index', ['order_by' => 'name']))
        ->assertStatus(200)
        ->assertJsonCount(2, 'data')
        ->getOriginalContent();

    expect($response->data[0]->id)->toBe($weir->id)
        ->and($response->data[1]->id)->toBe($tolkien->id);

    $response = $this->getJson(route('api.v2.authors.index', ['order_by' => '-name']))
        ->assertStatus(200)
        ->assertJsonCount(2, 'data')
        ->getOriginalContent();

    expect($response->data[0]->id)->toBe($tolkien->id)
        ->and($response->data[1]->id)->toBe($weir->id);
});

it('should show authors by ID via v1 API', function () {
    $weir = Author::factory()->create(['name' => 'Andy Weir']);
    expect(Author::count())->toBe(1);

    $this->getJson(route('api.v1.authors.show', ['author' => $weir->id]))
        ->assertStatus(200)
        ->assertJsonFragment([
            'id' => $weir->id,
            'name' => $weir->name,
            'photo_url' => $weir->photo_url,
            'bio' => $weir->bio,
        ]);
});

it('should show authors by ID via v2 API', function () {
    $weir = Author::factory()->create(['name' => 'Andy Weir']);
    expect(Author::count())->toBe(1);

    $this->getJson(route('api.v2.authors.show', ['author' => $weir->id]))
        ->assertStatus(200)
        ->assertJsonFragment([
            'id' => $weir->id,
            'full_name' => $weir->name,
            'country' => $weir->country,
            'biography' => $weir->bio,
            'photo_url' => $weir->photo_url,
        ]);
});
