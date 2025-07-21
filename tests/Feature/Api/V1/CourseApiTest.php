<?php

namespace Tests\Feature\Api\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Professor;
use App\Models\Course;
use App\Models\User;

class CourseApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
    }

    public function test_index_returns_courses()
    {
        // Arrange
        $prof = Professor::factory()->create();
        Course::factory()->count(2)->create(['professor_id' => $prof->id]);

        // Act
        $response = $this->getJson('/api/v1/courses');

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure(['data', 'status', 'success']);
        $this->assertGreaterThanOrEqual(2, count($response['data']));
    }

    public function test_index_with_professor_filter()
    {
        // Arrange
        $prof1 = Professor::factory()->create();
        $prof2 = Professor::factory()->create();
        Course::factory()->count(2)->create(['professor_id' => $prof1->id]);
        Course::factory()->count(2)->create(['professor_id' => $prof2->id]);

        // Act
        $response = $this->getJson("/api/v1/courses?professor_id={$prof1->id}");

        // Assert
        $response->assertStatus(200);
        foreach ($response['data'] as $course) {
            $this->assertEquals($prof1->id, $course['professor_id']);
        }
    }

    public function test_show_returns_single_course()
    {
        // Arrange
        $prof = Professor::factory()->create();
        $course = Course::factory()->create(['professor_id' => $prof->id]);

        // Act
        $response = $this->getJson("/api/v1/courses/{$course->id}");

        // Assert
        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $course->id]);
    }

    public function test_destroy_deletes_course()
    {
        // Arrange
        $prof = Professor::factory()->create();
        $course = Course::factory()->create(['professor_id' => $prof->id]);

        // Act
        $response = $this->deleteJson("/api/v1/courses/{$course->id}");

        // Assert
        $response->assertStatus(204);
        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
    }

    public function test_show_returns_404_for_missing_course()
    {
        // Act & Assert
        $response = $this->getJson('/api/v1/courses/999999');
        $response->assertStatus(404);
    }
}
