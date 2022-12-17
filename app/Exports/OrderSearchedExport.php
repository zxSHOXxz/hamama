<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderSearchedExport implements FromQuery, WithHeadings
{
    /**
     * @return Builder
     */

    use Exportable;
    public function headings(): array
    {
        return [
            'id',
            'customer',
            'price',
            'details',
            'status',
            'statusDetails',
            'captain_id',
            'client_id',
            'city_id',
            'created_at',
            'updated_at',
            'sub_city_id',
        ];
    }
    protected $query;
    public function setQuery($query)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query;
    }
}