<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CetegoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateCategory()
    {
        $this->withoutMiddleware();
        $response = $this->json('POST', '/api/create-category', ['name' => 'Категория2335' . time()]);

        $response
            ->assertStatus(201)
            ->assertJsonFragment(['Category create']);
    }
}
