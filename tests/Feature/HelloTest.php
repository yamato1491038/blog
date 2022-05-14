<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class HelloTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHello()
    {
        // $user = factory(User::class)->create();
        $user = User::find(1);
        $response = $this
            ->actingAs($user)
            ->get('/');
        $response->assertStatus(200);

        $this->assertTrue(true);
    }
}
