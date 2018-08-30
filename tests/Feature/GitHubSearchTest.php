<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GitHubSearchTest extends TestCase
{
    /** 
     * A basic test example.
     *
     * @return void
     */
    function test_WebSite_Front_Is_Working()
    {
        $this->get('/')
             ->assertStatus(200)
             ->assertSee('GitHub Users Search');
    }

    function test_GitHub_User()
    {
        $this->get('/user')
             ->assertStatus(200)
             ->assertJsonFragment(["message" => "OK"]);
    }
    }

    function test_GitHub_User_Search()
    {
        $this->get('/search/ingdanielsanchezve')
             ->assertStatus(200)
             ->assertJsonFragment(["login" => "ingdanielsanchezve"]);
    }

    function test_GitHub_UserSearch_User_Not_Found()
    {
        $this->get('/search/ingdanielsanchezve1233112')
             ->assertStatus(200)
             ->assertJsonFragment(["message" => "Not Found"]);
    }

    function test_GitHub_User_Followers_Search()
    {
        $this->get('/followers/michaelgiles/1')
             ->assertStatus(200)
             ->assertJsonFragment(["type" => "User"]);
    }

    function test_GitHub_User_Not_Have_Followers()
    {
        $this->get('/followers/ingdanielsanchezve/1')
             ->assertStatus(200)
             ->assertJsonFragment(["followers" => []]);
    }


}
