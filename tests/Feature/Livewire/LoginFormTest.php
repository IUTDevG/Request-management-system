<?php

namespace Tests\Feature\Livewire;

use App\Livewire\LoginForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class LoginFormTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(LoginForm::class)
            ->assertStatus(200);
    }
}
