<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AccountCreationTest extends DuskTestCase
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
    public function testAdminCreation()
    {
        $user = User::factory()->create([
            'email' => 'testsuperadmin@trackr.com',
        ]);
        $user->attachRole(1);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs('testsuperadmin@trackr.com')
                ->visit('/addemployee')
                ->type('first-name', 'Marcus')
                ->type('last-name', 'Hansen')
                ->type('email', 'marcus.hansen@example.com')
                ->type('password', 'password')
                ->press('Submit')
                ->logout()
                ->visit('/login')
                ->type('email', 'marcus.hansen@example.com')
                ->type('password', 'password')
                ->press('Submit')
                ->assertPathIs('/packages');
        });
    }

    public function testPackerCreation()
    {
        $user = User::factory()->create([
            'email' => 'testsuperadmin@trackr.com',
        ]);
        $user->attachRole(1);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs('testsuperadmin@trackr.com')
                ->visit('/addemployee')
                ->type('first-name', 'Blake')
                ->type('last-name', 'Douglas')
                ->type('email', 'blake.douglas@example.com')
                ->type('password', 'password')
                ->select('role', 'Packer')
                ->press('Submit')
                ->logout()
                ->visit('/login')
                ->type('email', 'blake.douglas@example.com')
                ->type('password', 'password')
                ->press('Submit')
                ->assertPathIs('/packages');
        });
    }

    public function testWebshopCreation()
    {
        $user = User::factory()->create([
            'email' => 'testsuperadmin@trackr.com',
        ]);
        $user->attachRole(1);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs('testsuperadmin@trackr.com')
                ->visit('/addwebshop')
                ->type('first-name', 'James')
                ->type('last-name', 'Solås')
                ->type('email', 'james.solas@example.com')
                ->type('password', 'password')
                ->type('company-name', 'Sad Koala')
                ->type('country', 'France')
                ->type('city', 'Nantes')
                ->type('street', 'Rue Dugas-Montbel')
                ->type('postal_code', '39563')
                ->type('house_number', 4023)
                ->press('Submit')
                ->logout()
                ->visit('/login')
                ->type('email', 'james.solas@example.com')
                ->type('password', 'password')
                ->press('Submit')
                ->assertPathIs('/addpackage');
        });
    }
}
