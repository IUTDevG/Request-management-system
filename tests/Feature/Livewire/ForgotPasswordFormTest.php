<?php

namespace Tests\Feature\Livewire;

use App\Livewire\ForgotPasswordForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ForgotPasswordFormTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(ForgotPasswordForm::class)
            ->assertStatus(200);
    }
}
