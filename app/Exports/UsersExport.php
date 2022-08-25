<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class UsersExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;
    private $ids;
    public function userIds(array $ids)
    {
        $this->ids = $ids;

        return $this;
    }

    public function query()
    {
        if(is_countable($this->ids)&&count($this->ids)>1){
            return User::query()->whereIn('id', $this->ids);
        }
        return User::query();
    }
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Gender',
            'Address',
            'City',
            'State',
            'Country',
        ];
    }
    public function map($user): array
    {
        return [
            $user->name.' '.$user->lastname,
            $user->email,
            $user->phone,
            User::GENDER_RADIO[$user->gender] ?? '',
            $user->address,
            $user->city->city_name??'',
            $user->state->state_name??'',
            $user->country->name??'',
        ];
    }

//    public function collection()
//    {
//        return User::all();
//    }
}
