<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class NewsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }


    public function test_my_News()
    {
        $userId = User::all();
        $user = User::findorfail($userId[0]->id);
        //$user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get('/news/6');
        $response->assertStatus(200);;
    }
}
