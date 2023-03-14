<?php

namespace App\Modules\User\Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Event;
use Symfony\Component\HttpFoundation\Response;
use App\Modules\User\Manager\Events\UserRegistered;

class UserRegistrationTest extends TestCase
{
    /**
     * @test
     *
     * @group user
     */
    public function user_can_register(): void
    {
        Event::fake();
        $userData = [
            'first_name'            => $this->faker->firstName(),
            'last_name'             => $this->faker->lastName(),
            'email'                 => $this->faker->email(),
            'password'              => $p = $this->faker->password(),
            'password_confirmation' => $p,
        ];

        $this->assertDatabaseCount('users', 0);
        $res = $this->json('post', '/api/register', $userData);

        $res->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseCount('users', 1);
        $res->assertJsonFragment(['email' => $userData['email']]);
    }

    /**
     * @test
     *
     * @group user
     */
    public function it_triggers_user_registered_event()
    {
        Event::fake();
        $userData = [
            'first_name'            => $this->faker->firstName(),
            'last_name'             => $this->faker->lastName(),
            'email'                 => $this->faker->email(),
            'password'              => $p = $this->faker->password(),
            'password_confirmation' => $p,
        ];

        $this->assertDatabaseCount('users', 0);
        $res = $this->json('post', '/api/register', $userData);

        $res->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseCount('users', 1);
        $res->assertJsonFragment(['email' => $userData['email']]);

        Event::assertDispatched(UserRegistered::class);
    }
}