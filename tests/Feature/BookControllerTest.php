<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\WriterModel;
use App\Models\BookModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Könyvek listázása egy adott írótól hitelesítés nélkül.
     */
    public function test_index_returns_books_by_author()
    {
        $writer = WriterModel::factory()->create(['name' => 'Teszt Író']);

        BookModel::factory()->create([
            'title' => 'Könyv 1',
            'author_id' => $writer->id
        ]);

        BookModel::factory()->create([
            'title' => 'Könyv 2',
            'author_id' => $writer->id
        ]);

        $response = $this->getJson("/api/writers/{$writer->id}/books");

        $response->assertStatus(200)
            ->assertJsonFragment(['title' => 'Könyv 1'])
            ->assertJsonFragment(['title' => 'Könyv 2']);
    }

    /**
     * Új könyv létrehozása, hitelesítés szükséges.
     */
    public function test_store_creates_new_book()
    {
        $writer = WriterModel::factory()->create(['name' => 'Író']);

        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson("/api/writers/{$writer->id}/books", [
            'title' => 'Új könyv',
            'iban' => 'ABC123',
            'price' => 123.45,
            'description' => 'Leírás'
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['title' => 'Új könyv']);

        $this->assertDatabaseHas('books', [
            'title' => 'Új könyv',
            'author_id' => $writer->id
        ]);
    }

    /**
     * Adott könyv módosítása, hitelesítés szükséges.
     */
    public function test_update_modifies_book()
    {
        $writer = WriterModel::factory()->create();
        $book = BookModel::factory()->create([
            'author_id' => $writer->id,
            'title' => 'Eredeti cím'
        ]);

        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->patchJson("/api/writers/{$writer->id}/books/{$book->id}", [
            'title' => 'Módosított cím'
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['title' => 'Módosított cím']);

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Módosított cím'
        ]);
    }

    /**
     * Nem létező könyv módosítása - 404-es hibakód
     */
    public function test_update_returns_404_for_missing_book()
    {
        $writer = WriterModel::factory()->create();

        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->patchJson("/api/writers/{$writer->id}/books/999", [
            'title' => 'Valami'
        ]);

        $response->assertStatus(404)
            ->assertJsonFragment(['message' => 'Book not found!']);
    }

    /**
     * Egy adott könyv törlése, hitelesítés szükséges.
     */
    public function test_delete_removes_book()
    {
        $writer = WriterModel::factory()->create();
        $book = BookModel::factory()->create(['author_id' => $writer->id]);

        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->deleteJson("/api/writers/{$writer->id}/books/{$book->id}");

        $response->assertStatus(410)
            ->assertJsonFragment(['message' => 'Deleted']);

        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
