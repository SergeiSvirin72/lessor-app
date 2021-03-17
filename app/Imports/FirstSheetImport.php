<?php

namespace App\Imports;

use App\Models\Statement;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;

class FirstSheetImport implements ToModel, WithStartRow, SkipsOnFailure, WithValidation
{
    use SkipsFailures;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $statement = Statement::updateOrCreate(
            ['document_number' => $row[14], 'vo' => $row[16]],
            [
                'team_id' => request()->route('team')->id,
                'date' => Carbon::instance(Date::excelToDateTimeObject((Float) $row[1])),
                'debet_account' => $row[4],
                'credit_account' => $row[8],
                'debet_amount' => $row[9] ?: null,
                'credit_amount' => $row[13] ?: null,
                'bank' => $row[17],
                'purpose' => $row[20]
            ]
        );
    }

    public function startRow(): int
    {
        return 12;
    }

    public function rules(): array
    {
        return [
            '1' => ['required'],
            '4' => ['required'],
            '8' => ['required'],
            '14' => ['required'],
            '16' => ['required'],
            '17' => ['required'],
            '20' => ['required'],
        ];
    }
}
