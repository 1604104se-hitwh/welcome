<?php

namespace App\Exports;

use App\Models\ShtlRecord;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class portBookExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $raws;
    public function collection()
    {
        $this->raws = 0;
        return ShtlRecord::leftJoin('t_shtl_port','t_shtl_port.id','t_shtl_record.shtl_id')
            ->groupBy('t_shtl_record.record_time','t_shtl_record.shtl_id','t_shtl_port.port_name')
            ->get([
                DB::raw('count(*) as number'),
                't_shtl_port.port_name as name',
                't_shtl_record.record_time as time'
            ]);
    }

    public function headings(): array
    {
        return [
            '#',
            '站点',
            '时间',
            '人数'
        ];
    }

    public function map($invoice): array
    {
        $this -> raws++;
        return [
            $this -> raws,
            $invoice -> name,
            $invoice -> time,
            $invoice -> number,
        ];
    }
}
