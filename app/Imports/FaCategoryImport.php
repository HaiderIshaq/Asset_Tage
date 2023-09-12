<?php

namespace App\Imports;
use App\campus;
use App\fa_category;
use App\fa_sub_category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FaCategoryImport implements  ToModel, WithHeadingRow
{ 
    
    // public function model(array $row)
    // {
    //     return new campus([
    //         'name'  => $row['name'],
    //         'id' => $row['code'],
    //         'district_id' => $row['district_id'],
      
        
    //     ]);
    // }
     public function model(array $row)
    {
        return new campus([
            'name'  => $row['name'],
             'id' => $row['code'],
            'district_id' => $row['district_id'],
            'address'  => $row['address'],
            'city'  => $row['city'],
           
            
      
        
        ]);
    }
}
