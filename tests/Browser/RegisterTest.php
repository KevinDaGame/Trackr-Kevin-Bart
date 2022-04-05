<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    use DatabaseMigrations;
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('first-name', 'Jan')
                ->type('last-name', 'Pan')
                ->type('email', 'janpan@gmail.com')
                ->type('password', 'password')
                ->press('Submit')
                ->assertPathIs('/findpackage');
        });
    }
}
