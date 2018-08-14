<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ItemTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateItem()
    {
        $this->withoutMiddleware();
        $response = $this->json('POST', '/api/create-item', [
            'name'     => 'ТОвар',
            'category' => '3,4'
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonFragment(['Item create']);
    }
}
