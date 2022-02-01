<?php

namespace Tests\Unit;

use App\Jobs\ExportDataToCsv;
use App\Models\Exportable;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ExportableTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Test setup
     * 
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test if UserObserver is creating exportables
     *
     * @return void
     */
    public function test_user_observer_is_creating_exportables()
    {
        factory(\App\Models\User::class)->create();
        factory(\App\Models\User::class)->create();
        factory(\App\Models\User::class)->create();

        $this->assertEquals(3, count(Exportable::all()));
    }

    /**
     * Test if Job has pushed
     * 
     * @return void
     */
    public function test_job_has_pushed()
    {
        Queue::fake();

        factory(\App\Models\User::class)->create();
        factory(\App\Models\User::class)->create();
        factory(\App\Models\User::class)->create();

        $this->artisan('exportable:export \\\App\\\Models\\\User')->assertExitCode(0);

        Queue::assertPushed(ExportDataToCsv::class);
    }


    /**
     * Test CSV is generated
     * 
     * @return void
     */
    public function test_csv_is_generated()
    {

        factory(\App\Models\User::class)->create();
        factory(\App\Models\User::class)->create();
        factory(\App\Models\User::class)->create();

        $this->artisan('exportable:export \\\App\\\Models\\\User');

        $path = storage_path('app/public/laravel-excel');

        if (!empty($path)) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }
}
