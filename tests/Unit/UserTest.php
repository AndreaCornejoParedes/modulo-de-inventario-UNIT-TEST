<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_login()
    {
        $response=$this->get('/login');
        $response->assertStatus(200);
    }
}
