<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Models\Menus;
use App\Models\Menurole;
use App\Models\MenusLang;
use App\Models\User;

class MenuTest extends TestCase
{
    use DatabaseMigrations;

    /*
        Testing: Route::get('menu', 'MenuController@index');
    */
    /*
    public function testEditMenu(){
        $user = User::factory()->admin()->create();
        $user->assignRole($roleAdmin);
        $response = $this->actingAs($user)->get('/menu');
        $response->assertSee('<option>guest</option>');
        $response->assertSee('<option>user</option>');
        $response->assertSee('<option>admin</option>');
    }
    */
    /*
        Testing: Route::get('menu/selected', 'MenuController@menuSelected')->name('menu.selected');
    */
    /*
    public function testMenuSelected(){
        DB::table('menus')->insert([
            'href' => '/href',
            'slug' => 'link',
            'menu_id' => 1,
            'sequence' => 1,
        ]);
        $lastId = DB::getPdo()->lastInsertId();
        DB::table('menu_role')->insert([
            'role_name' => 'guest',
            'menus_id' => $lastId,
        ]);
        DB::table('menus_lang')->insert([
            'name' => 'name',
            'menus_id' => $lastId,
            'lang' => 'en',
        ]);
        //$menuElement = factory('App\Menurole')->create();
        $user = User::factory()->admin()->create();
        $user->assignRole($roleAdmin);
        $response = $this->actingAs($user)->get('menu/selected?role=guest');
        $response->assertSee('<a class="btn btn-primary" href="/menu/selected/switch?id=' . $lastId);
    }
    */
    /*
        Testing: Route::get('menu/selected/switch', 'MenuController@switch');
    */
    /*
    public function testMenuSwitch(){
        $menuElement = factory('App\Menurole')->create();
        $user = User::factory()->admin()->create();
        $user->assignRole($roleAdmin);
        $response = $this->actingAs($user)->get('menu/selected/switch?role=guest&id=' . $menuElement->menus_id);
        $this->assertDatabaseMissing('menu_role',['menus_id' => $menuElement->menus_id, 'role_name' => 'guest']);
        $response = $this->actingAs($user)->get('menu/selected/switch?role=guest&id=' . $menuElement->menus_id);
        $this->assertDatabaseHas('menu_role',['menus_id' => $menuElement->menus_id, 'role_name' => 'guest']);
    }
    */
}