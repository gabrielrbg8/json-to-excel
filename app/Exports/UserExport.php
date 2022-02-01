<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserExport implements FromCollection,  WithHeadings
{
    use Exportable;

    public $exportable;

    public function __construct($exportable = null)
    {
        $this->exportable = collect($exportable);
    }

    public function collection()
    {
        return $this->exportable;
    }


    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name'
        ];
    }

    public function map($exportable): array
    {
        return [
            $exportable->id,
            $exportable->name
        ];
    }
}
