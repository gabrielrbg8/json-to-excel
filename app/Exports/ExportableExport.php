<?php

namespace App\Exports;

use App\Models\Exportable;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable as TraitExportable;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class ExportableExport implements FromCollection, WithHeadings
{
    use TraitExportable;
    
    public $exportable;

    public function __construct(Collection $exportable)
    {
        $this->exportable = $exportable;
    }

    public function collection()
    {
        return $this->exportable;
    }

    public function headings(): array
    {
        return [
           ['First row', 'First row'],
        ];
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
}
