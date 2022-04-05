<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TokenTest extends DuskTestCase
{
    use DatabaseMigrations;
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function testMakeToken()
    {
        $user = User::factory()->create([
            'email' => 'testwebshop@trackr.com',
        ]);
        $user->attachRole(4);
        $this->browse(function (Browser $browser) {
            $browser->loginAs('testwebshop@trackr.com');
            $browser->visit('/webshop/tokens')
                ->type('tokenName', 'TestToken')
                ->press('Create token')
                ->assertSee('Token created!');
        });
    }
}
