<?php

namespace App\Jobs;

use App\Exports\ExportableExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ExportDataToCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $exportables;

    public $exportClass;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Collection $exportables)
    {
        $this->exportables = $exportables;
        $this->exportClass = $this->getExportClass();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Excel::download(new $this->exportClass($this->getDataToExport()), 'exportable_' . uniqid() . '.csv');
       // $this->markAsExported();
        return 0;
    }

    public function getExportClass()
    {
        $modelToExport = $this->exportables[0]->exportable_type;
        $modelToExport = explode('\\', $modelToExport);
        $exportClass =  'App\Exports\\' . $modelToExport[2] . 'Export';

        return $exportClass;
    }

    public function getDataToExport()
    {
        $exportables = [];

        foreach ($this->exportables as $exportable) {
            $exportables[] = $exportable->exportable_type::find($exportable->exportable_id);
        }
        return $exportables;
    }

    public function markAsExported()
    {
        foreach ($this->exportables as $exportable) {
            $exportable->exported = true;
            $exportable->save();
        }
    }
}
