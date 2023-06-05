<?php

namespace App\Imports;

use App\Models\Revenew;
use Maatwebsite\Excel\Concerns\ToModel;

class RevenuesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       $revenue = new Revenew([
            'operator'      => $row['0'],
            'service_id'    => $row['1'], 
            'revenew' =>    $row['2'],
            'revenew' => $row['3'],
            'entry_date' => $row['4'],
        ]);

        return $revenue;
    }
}
