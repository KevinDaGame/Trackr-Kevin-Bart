<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Chrome;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
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

    public function testCustomerLogin()
    {
        $user = User::factory()->create([
            'email' => 'testcustomer@trackr.com',
        ]);
        $user->attachRole(config('roles.models.role')::where('name', '=', 'Customer')->first());
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'password')
                ->press('Submit')
                ->assertPathIs('/findpackage')
                ->logout();
        });
    }

    public function testWebshopLogin()
    {
        $user = User::factory()->create([
            'email' => 'testwebshop@trackr.com',
        ]);
        $user->attachRole(4);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'password')
                ->press('Submit')
                ->assertPathIs('/addpackage')
                ->logout();
        });
    }

    public function testPackerLogin()
    {
        $user = User::factory()->create([
            'email' => 'testpacker@trackr.com',
        ]);
        $user->attachRole(3);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'password')
                ->press('Submit')
                ->assertPathIs('/packages')
                ->logout();
        });
    }

    public function testAdminLogin()
    {
        $user = User::factory()->create([
            'email' => 'testadmin@trackr.com',
        ]);
        $user->attachRole(2);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'password')
                ->press('Submit')
                ->assertPathIs('/packages')
                ->logout();
        });
    }

    public function testSuperAdminLogin()
    {
        $user = User::factory()->create([
            'email' => 'testsuperadmin@trackr.com',
        ]);
        $user->attachRole(1);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'password')
                ->press('Submit')
                ->assertPathIs('/packages')
                ->logout();
        });
    }
}
