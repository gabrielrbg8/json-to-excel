<?php

namespace App\Console\Commands;

use App\Jobs\ExportDataToCsv as JobsExportDataToCsv;
use App\Models\Exportable;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class ExportDataToCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exportable:export {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command exports a model data to CSV';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $modelName = $this->argument('model');
        if (!class_exists($modelName)) {
            $this->error('Model ' . $this->argument('model') . ' does not exist.');
            return -1;
        }

        $model = new $modelName();

        if ($model instanceof Model) {
            $exportables = Exportable::where('exported', false)->get();
            if ($exportables->isEmpty()) {
                $this->info('Doesnt exists data to export');
                return -1;
            }
            JobsExportDataToCsv::dispatch($exportables->sortByDesc('created_at'));
            return 0;
        } else {
            $this->error('Model ' . $this->argument('model') . ' does not exist.');
            return -1;
        }
    }
}
