<?php

namespace Tests\Browser;

use App\Models\Package;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SavePackageTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function testSavePackage()
    {
        $package = Package::create([
            'sender_id' => '1',
            'recipient_id' => '1',
            'status' => 'Printed'
        ]);
        $user = User::factory()->create([
            'email' => 'testcustomer@trackr.com',
        ]);
        $user->attachRole(config('roles.models.role')::where('name', '=', 'Customer')->first());
        $this->browse(function (Browser $browser) use ($package) {
            $browser->loginAs('testcustomer@trackr.com');
            $browser->visit('/')
                ->type('trace-code', $package->id)
                ->type('postal-code', $package->recipient->address->postal_code)
                ->press('Search')
                ->press('Save this package')
                ->clickLink('My packages')
                ->assertSee($package->id);
        });
    }
}
