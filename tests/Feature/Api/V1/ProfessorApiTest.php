<?php

namespace Tests\Feature\Api\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Professor;
use App\Models\User;

class ProfessorApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
    }

    public function test_index_returns_professors()
    {
        // Arrange
        Professor::factory()->count(2)->create();

        // Act
        $response = $this->getJson('/api/v1/professors');

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure(['data', 'status', 'success']);
        $this->assertGreaterThanOrEqual(2, count($response['data']));
    }

    public function test_show_returns_single_professor()
    {
        // Arrange
        $prof = Professor::factory()->create();

        // Act
        $response = $this->getJson('/api/v1/professors/' . $prof->id);

        // Assert
        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $prof->id]);
    }

    public function test_destroy_deletes_professor()
    {
        // Arrange
        $prof = Professor::factory()->create();

        // Act
        $response = $this->deleteJson('/api/v1/professors/' . $prof->id);

        // Assert
        $response->assertStatus(204);
        $this->assertDatabaseMissing('professors', ['id' => $prof->id]);
    }

    public function test_show_returns_404_for_missing_professor()
    {
        // Act & Assert
        $response = $this->getJson('/api/v1/professors/99999');
        $response->assertStatus(404);
    }
}
