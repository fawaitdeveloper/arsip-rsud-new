<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class EmployeeImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($row[1] != null && $row[1] != "NAMA") {
                $employee = Employee::where("nip", $row[2])->first();
                if ($employee) {
                    $employee->update([
                        'name' => $row[1] ?? '',
                        'nip' => $row[2] ?? '',
                        'unit' => $row[3] ?? '',
                        'position' => $row[4] ?? '',
                    ]);
                } else {
                    Employee::create([
                        'name' => $row[1] ?? '',
                        'nip' => $row[2] ?? '',
                        'unit' => $row[3] ?? '',
                        'position' => $row[4] ?? '',
                    ]);
                }
            }
        }
    }
}
