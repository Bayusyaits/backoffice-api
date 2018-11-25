<?php

namespace Tests\Feature;
use app\Http\Controllers\Frontend\DynMenuController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DynMenuTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        // $response->assertStatus(200);
        $this->assertEquals('Home', $response->getContent());
    }
}
