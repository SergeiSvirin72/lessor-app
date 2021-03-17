<?php

namespace App\Imports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SecondSheetImport implements ToCollection
{
    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        $values = [];
        foreach ($rows as $row) {
            if (empty($row[1])
                || empty($row[4])
                || empty($row[8])
                || empty($row[14])
                || empty($row[16])
                || empty($row[17])
                || empty($row[20])) {
                continue;
            }

            $values[] = [
                'team_id' => Auth::user()->team_id,
                'date' => Carbon::instance(Date::excelToDateTimeObject((Float) $row[1])),
                'debet_account' => $row[4],
                'credit_account' => $row[8],
                'amount' => $row[9] ?: $row[13],
                'document_number' => $row[14],
                'vo' => $row[16],
                'bank' => $row[17],
                'purpose' => $row[20]
            ];
        }
//        $values = implode(', ', $values);

        DB::table('statements')->upsert($values, [
            'document_number', 'vo'
        ], [
            'team_id', 'date', 'debet_account', 'credit_account', 'amount', 'bank', 'purpose'
        ]);
    }
}
