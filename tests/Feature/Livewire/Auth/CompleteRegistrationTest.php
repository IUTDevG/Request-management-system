<?php

namespace Tests\Feature\Livewire\Auth;

use App\Livewire\Auth\CompleteRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CompleteRegistrationTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(CompleteRegistration::class)
            ->assertStatus(200);
    }
}
