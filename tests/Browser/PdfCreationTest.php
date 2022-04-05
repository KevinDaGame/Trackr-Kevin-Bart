<?php

namespace Tests\Browser;

use App\Models\Package;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PdfCreationTest extends DuskTestCase
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
    public function testSinglePdfCreation()
    {
        $user = User::factory()->create([
            'email' => 'testsuperadmin@trackr.com',
        ]);
        $user->attachRole(1);


        $package = Package::create([
            'sender_id' => 1,
            'recipient_id' => 1,
            'status' => 'Reported'
        ]);

        $this->browse(function (Browser $browser) use ($package) {
            $browser->loginAs('testsuperadmin@trackr.com')
                    ->visit('/generate-pdf?id=' . $package->id)
                    //->assertQueryStringHas('id', $package->id)
                    ->assertPathIs('/generate-pdf');
        });
    }

    public function testMultiPdfCreation()
    {
        $user = User::factory()->create([
            'email' => 'testsuperadmin@trackr.com',
        ]);
        $user->attachRole(1);

        $package = Package::create([
            'sender_id' => 1,
            'recipient_id' => 1,
            'status' => 'Reported'
        ]);

        $this->browse(function (Browser $browser) use ($package) {
            $browser->loginAs('testsuperadmin@trackr.com')
                    ->visit('/packages')
                    ->check('dl' . $package->id)
                    ->press('Download selected orders as pdf')
                    ->waitFor(2000)
                    ->assertPathBeginsWith('/generate-pdfs');
        });
    }
}
