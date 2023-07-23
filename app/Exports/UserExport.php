<?php

namespace App\Exports;

use App\Models\User;

use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class UserExport extends DefaultValueBinder implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithCustomValueBinder
{
    public function collection() {
        return User::all();
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->nama_lengkap,
            $user->username,
            $user->no_hp,
            $user->email,
            $user->role,
            $user->status,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Lengkap',
            'Username',
            'No Hp',
            'Email',
            'Role',
            'Status'
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }
        return parent::bindValue($cell, $value);
    }
}
