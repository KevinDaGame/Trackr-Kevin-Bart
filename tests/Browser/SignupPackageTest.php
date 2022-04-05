<?php

namespace Tests\Browser;

use App\Models\Package;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SignupPackageTest extends DuskTestCase
{
    use DatabaseMigrations;
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function testPackageSignup()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs('webshop@trackr.com');
            $browser->visit('/addpackage')
                    ->type('recipient-name', 'Jan Pan')
                ->type('recipient-phone_number', '0634567823')
                ->type('recipient-email', 'Jan@pan.nl')
                ->type('recipient-street', 'Koestraat')
                ->type('recipient-house_number', '18')
                ->type('recipient-addition', 'A')
                ->type('recipient-postal_code', '5476GD')
                ->type('recipient-city', 'Amsterdam')
                ->type('recipient-country', 'Nederland')
                ->type('notes', 'This package was set as a test')
                ->press('Submit')
                ->assertsee('The following packages are succesfully added:')
                ->logout();
        });
    }

    public function testFindPackage()
    {
        $package = Package::create([
            'sender_id' => '1',
            'recipient_id' => '1',
            'status' => 'Printed'
        ]);
        $this->browse(function (Browser $browser) use ($package) {
            $browser->visit('/findpackage')
                ->type('trace-code', $package->id)
                ->type('postal-code', $package->recipient->address->postal_code)
                ->press('Search')
                ->assertSee('Current status');
        });
    }
}
