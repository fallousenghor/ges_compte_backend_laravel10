<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Compte;

class CompteListTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        // s'assurer que les seeders et migrations sont appliqués si nécessaire
        $this->artisan('migrate:fresh');
    }

    public function test_list_comptes_returns_expected_structure()
    {
        // Create a user and multiple comptes
        $user = User::factory()->create();
        Compte::factory()->count(3)->for($user, 'titulaire')->create();

        $response = $this->getJson('/api/comptes');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data'
            ]);

        $this->assertCount(3, $response->json('data'));
    }
}
