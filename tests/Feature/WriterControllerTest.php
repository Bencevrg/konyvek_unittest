<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\WriterModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WriterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Írók lekérése hitelesítés nélkül.
     */

    public function test_index_returns_all_writers()
    {
        WriterModel::factory()->create(['name' => 'Jókai Mór']);
        WriterModel::factory()->create(['name' => 'George Orwell']);

        $response = $this->getJson('/api/writers');

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Jókai Mór'])
            ->assertJsonFragment(['name' => 'George Orwell']);
    }

    /**
     * Új író létrehozása, hitelesítés szükséges.
     */
    public function test_store_creates_new_writer()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/writers', [
            'name' => 'Fekete István',
            'bio' => 'Tüskevár írója'
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Fekete István']);

        $this->assertDatabaseHas('writers', [
            'name' => 'Fekete István'
        ]);
    }

    /**
     * Író módosítása, hitelesítés szükséges.
     */

    public function test_update_modifies_existing_writer()
    {
        $writer = WriterModel::factory()->create(['name' => 'Eredeti Név']);

        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->patchJson("/api/writers/{$writer->id}", [
            'name' => 'Módosított Név'
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Módosított Név']);

        $this->assertDatabaseHas('writers', [
            'id' => $writer->id,
            'name' => 'Módosított Név'
        ]);
    }

    /**
     * Nem létező író módosítása – 404-es hibakód
     */
    public function test_update_returns_404_if_writer_not_found()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->patchJson('/api/writers/999', [
            'name' => 'Nem számít'
        ]);

        $response->assertStatus(404)
            ->assertJsonFragment(['message' => 'Not found!']);
    }

    /**
     * Adott író törlése, hitelesítés szükséges
     */
    public function test_delete_removes_writer()
    {
        $writer = WriterModel::factory()->create(['name' => 'Törlendő Író']);

        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->deleteJson("/api/writers/{$writer->id}");

        $response->assertStatus(410)
            ->assertJsonFragment(['message' => 'Deleted']);

        $this->assertDatabaseMissing('writers', ['id' => $writer->id]);
    }
}
