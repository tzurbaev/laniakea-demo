<?php

declare(strict_types=1);

use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

it('should create genres via v1 API', function () {
    expect(Genre::count())->toBe(0);

    $this->postJson(route('api.v1.genres.store'), ['name' => 'Science Fiction'])
        ->assertStatus(200)
        ->assertJsonFragment([
            'slug' => 'science-fiction',
            'name' => 'Science Fiction',
        ]);

    expect(Genre::count())->toBe(1);
});

it('should list genres via v1 API', function () {
    $sciFi = Genre::create(['slug' => Str::slug('Science Fiction'), 'name' => 'Science Fiction']);
    $fantasy = Genre::create(['slug' => Str::slug('Fantasy'), 'name' => 'Fantasy']);

    expect(Genre::count())->toBe(2);

    $this->getJson(route('api.v1.genres.index'))
        ->assertStatus(200)
        ->assertJsonCount(2, 'data')
        ->assertJsonFragment([
            'id' => $sciFi->id,
            'slug' => $sciFi->slug,
            'name' => $sciFi->name,
        ])
        ->assertJsonFragment([
            'id' => $fantasy->id,
            'slug' => $fantasy->slug,
            'name' => $fantasy->name,
        ]);
});

it('should paginate genres via v1 API', function () {
    $sciFi = Genre::create(['slug' => Str::slug('Science Fiction'), 'name' => 'Science Fiction']);
    $fantasy = Genre::create(['slug' => Str::slug('Fantasy'), 'name' => 'Fantasy']);

    expect(Genre::count())->toBe(2);

    $this->getJson(route('api.v1.genres.index', ['page' => 2, 'count' => 1]))
        ->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonMissing([
            'id' => $sciFi->id,
            'slug' => $sciFi->slug,
            'name' => $sciFi->name,
        ])
        ->assertJsonFragment([
            'id' => $fantasy->id,
            'slug' => $fantasy->slug,
            'name' => $fantasy->name,
        ]);
});

it('should filter genres with search filter via v1 API', function () {
    $sciFi = Genre::create(['slug' => Str::slug('Science Fiction'), 'name' => 'Science Fiction']);
    $fantasy = Genre::create(['slug' => Str::slug('Fantasy'), 'name' => 'Fantasy']);

    expect(Genre::count())->toBe(2);

    $this->getJson(route('api.v1.genres.index', ['search' => 'fiction']))
        ->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonFragment([
            'id' => $sciFi->id,
            'slug' => $sciFi->slug,
            'name' => $sciFi->name,
        ])
        ->assertJsonMissing([
            'id' => $fantasy->id,
            'slug' => $fantasy->slug,
            'name' => $fantasy->name,
        ]);
});

it('should sort genres via v1 API', function () {
    $sciFi = Genre::create(['slug' => Str::slug('Science Fiction'), 'name' => 'Science Fiction']);
    $fantasy = Genre::create(['slug' => Str::slug('Fantasy'), 'name' => 'Fantasy']);

    expect(Genre::count())->toBe(2);

    $response = $this->getJson(route('api.v1.genres.index', ['order_by' => 'name']))
        ->assertStatus(200)
        ->assertJsonCount(2, 'data')
        ->getOriginalContent();

    expect($response->data[0]->id)->toBe($fantasy->id)
        ->and($response->data[1]->id)->toBe($sciFi->id);

    $response = $this->getJson(route('api.v1.genres.index', ['order_by' => '-name']))
        ->assertStatus(200)
        ->assertJsonCount(2, 'data')
        ->getOriginalContent();

    expect($response->data[0]->id)->toBe($sciFi->id)
        ->and($response->data[1]->id)->toBe($fantasy->id);
});

it('should show genres by ID via v1 API', function () {
    $sciFi = Genre::create(['slug' => Str::slug('Science Fiction'), 'name' => 'Science Fiction']);

    expect(Genre::count())->toBe(1);

    // Genres are identified by slug, not by ID.
    $this->getJson(route('api.v1.genres.show', ['genre' => $sciFi->slug]))
        ->assertStatus(200)
        ->assertJsonFragment([
            'id' => $sciFi->id,
            'slug' => $sciFi->slug,
            'name' => $sciFi->name,
        ]);
});
