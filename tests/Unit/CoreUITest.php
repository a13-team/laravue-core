<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CoreUITest extends TestCase
{

    public function setUp() :void {
        parent::setUp();
    }

    public function testHomepage(){
        $response = $this->get( '/' );
        $response->assertStatus(200);
    }

}
