<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ListingImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return $row;
    }
}