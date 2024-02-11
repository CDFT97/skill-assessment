<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InertiaTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    private function getAuthenticatedUser()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
    }
    public function test_show_5_random_quotes()
    {
        $this->getAuthenticatedUser();

        $response = $this->get(route('quotes.fiverandom'));

        $response->assertInertia(
            fn ($component) => $component
            ->component('Quotes/FiveRandom')
            ->has('quotes',5)
        );
    }
}
