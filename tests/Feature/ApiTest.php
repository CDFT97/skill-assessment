<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\assertJson;

class ApiTest extends TestCase
{
  use RefreshDatabase;

  public function setUp(): void
  {
    parent::setUp();

    $this->artisan('db:seed');
  }

  private function getAuthenticatedUserToken(): string
  {
    $user = User::factory()->create();

    $response = $this->postJson('/api/login', [
      'email' => $user->email,
      'password' => 'password',
    ])
      ->assertSessionHasNoErrors()
      ->assertStatus(Response::HTTP_OK)
      ->getData();

    return strval($response->token);
  }

  public function test_user_can_login()
  {
    $user = User::factory()->create();

    $this->postJson('/api/login', [
      'email' => $user->email,
      'password' => 'password',
    ])
      ->assertSessionHasNoErrors()
      ->assertStatus(Response::HTTP_OK);
  }

  public function test_user_can_not_login_with_invalid_credentials()
  {
    $user = User::factory()->create();

    $this->postJson('/api/login', [
      'email' => $user->email,
      'password' => 'wrong_password',
    ])
      ->assertStatus(Response::HTTP_UNAUTHORIZED);
  }

  public function test_get_random_quotes_from_api()
  {
    $token = $this->getAuthenticatedUserToken();

    $quantity = rand(1, 7);

    $this->withHeaders(['Authorization' => 'Bearer ' . $token])
      ->getJson("api/quotes/random-quotes/$quantity")
      ->assertStatus(Response::HTTP_OK);
  }

  public function test_get_user_favorite_quotes()
  {
    $token = $this->getAuthenticatedUserToken();

    $this->withHeaders(['Authorization' => 'Bearer ' . $token])
      ->getJson("api/quotes/my-favorites")
      ->assertStatus(Response::HTTP_OK);
  }

  public function test_create_and_remove_favorite_quote()
  {
    $token = $this->getAuthenticatedUserToken();

    $data = [
      "id" => 15,
      "author" => "Jean Paul",
      "quote" => "lorem ipsum dolor sit amet consectetur adipiscing elit",
    ];

    $quote = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
      ->postJson("api/quotes/store", $data)
      ->assertStatus(Response::HTTP_CREATED)
      ->getData();

    $this->withHeaders(['Authorization' => 'Bearer ' . $token])
      ->deleteJson("api/quotes/remove/{$quote->id}")
      ->assertStatus(Response::HTTP_NO_CONTENT);
  }
}
