<?php

use App\Models\Exportable;
use Illuminate\Database\Seeder;

class ExportableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * The sleep of 10 seconds make sure that the order is executed in DESC sort
     *
     * @return void
     */
    public function run()
    {
        factory(Exportable::class)->create();
        sleep(10);
        factory(Exportable::class)->create();
        sleep(10);
        factory(Exportable::class)->create();
        sleep(10);
    }
}
