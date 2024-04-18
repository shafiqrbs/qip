<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FileExportExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ProductFile::all();
    }

    public function headings(): array
    {
        return [

        ];
    }

    public function map($fileimport): array
    {
        return [

        ];
    }
}
