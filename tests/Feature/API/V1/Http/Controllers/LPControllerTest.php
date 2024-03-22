<?php

namespace API\V1\Http\Controllers;

use App\Models\User;
use App\Models\V1\LP;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LPControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testIndexReturnListOfLps()
    {
        $user = User::factory()->create();
        //Create 5 lps with the factory
        LP::factory()->count(5)->create();

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/v1/lps');

        $response->assertOk()
            ->assertJsonCount(5, 'data');
    }

    /** @test */
    public function testStoreCreatesNewLPAndReturnsIt()
    {
        $user = User::factory()->create();

        $lpData = [
            'title' => 'New LP',
            'description' => 'LP description',
        ];

        $this->actingAs($user, 'sanctum')->postJson('/api/v1/lps', $lpData);

        //Assert the user is in database
        $this->assertDatabaseHas('l_p_s', ['title' => $lpData['title']]);
    }

    /** @test */
    public function testShowReturnsLP()
    {
        $user = User::factory()->create();
        $lp = LP::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->getJson("/api/v1/lps/{$lp->id}");

        $response->assertOk()
            ->assertJson(['data' => ['id' => $lp->id]]);
    }

    /** @test */
    public function testUpdateModifiesExistingLPAndReturnsIt()
    {
        $user = User::factory()->create();
        $lp = LP::factory()->create();
        $updatedData = [
            'title' => 'Updated LP',
            'description' => 'Updated LP description',
        ];

        $this->actingAs($user, 'sanctum')->putJson("/api/v1/lps/{$lp->id}", $updatedData);

        //Assert the user is in database
        $this->assertDatabaseHas('l_p_s', ['title' => $updatedData['title']]);
    }

    /** @test */
    public function testDestroyDeletesAnLP()
    {
        $user = User::factory()->create();
        $lp = LP::factory()->create();

        $this->actingAs($user, 'sanctum')->deleteJson("/api/v1/lps/{$lp->id}");

        $this->assertDatabaseMissing('l_p_s', ['id' => $lp->id]);
    }
}
