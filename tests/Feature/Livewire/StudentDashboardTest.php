<?php

namespace Tests\Feature\Livewire;

use App\Livewire\StudentDashboard;
use App\Models\SchoolRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class StudentDashboardTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function renders_successfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        SchoolRequest::factory()->count(10)->create(['user_id' => $user->id]);

        $response = $this->get(route('student.home'));

        $response->assertStatus(200);
        $response->assertSee('Requests');
    }
}
