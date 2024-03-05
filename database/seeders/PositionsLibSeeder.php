<?php

namespace Database\Seeders;

use App\PositionsLib;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PositionsLibSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions_lib')->delete();
        $data = [
            [//1
                'id' => '1',
                'title' => 'BRANCH MANAGER',
                'created_at' => Carbon::now('Asia/Manila'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'id' => '2',
                'title' => 'MEDICAL SPECIALIST III',
                'created_at' => Carbon::now('Asia/Manila'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'id' => '3',
                'title' => 'CHIEF SOCIAL INSURANCE OFFICER',
                'created_at' => Carbon::now('Asia/Manila'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'id' => '4',
                'title' => 'PLANNING OFFICER III',
                'created_at' => Carbon::now('Asia/Manila'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'id' => '5',
                'title' => 'COMPUTER MAINTENANCE TECHNOLOGIST II',
                'created_at' => Carbon::now('Asia/Manila'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'id' => '6',
                'title' => 'SOCIAL INSURANCE ASSISTANT I',
                'created_at' => Carbon::now('Asia/Manila'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'id' => '7',
                'title' => 'SOCIAL INSURANCE OFFICER I',
                'created_at' => Carbon::now('Asia/Manila'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'id' => '8',
                'title' => 'SOCIAL INSURANCE OFFICER II',
                'created_at' => Carbon::now('Asia/Manila'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'id' => '9',
                'title' => 'SOCIAL INSURANCE OFFICER III',
                'created_at' => Carbon::now('Asia/Manila'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'id' => '10',
                'title' => 'FISCAL EXAMINER A',
                'created_at' => Carbon::now('Asia/Manila'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'id' => '11',
                'title' => 'ADMINISTRATIVE SERVICE ASSISTANT I',
                'created_at' => Carbon::now('Asia/Manila'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'id' => '12',
                'title' => 'ADMINISTRATIVE OFFICER I',
                'created_at' => Carbon::now('Asia/Manila'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'id' => '13',
                'title' => 'ADMINISTRATIVE OFFICER II',
                'created_at' => Carbon::now('Asia/Manila'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'id' => '14',
                'title' => 'ADMINISTRATIVE SERVICE ASSISTANT C',
                'created_at' => Carbon::now('Asia/Manila'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'id' => '15',
                'title' => 'CASH CLERK',
                'created_at' => Carbon::now('Asia/Manila'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'id' => '16',
                'title' => 'FISCAL CLERK III',
                'created_at' => Carbon::now('Asia/Manila'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'id' => '17',
                'title' => 'FISCAL CONTROLLER I',
                'created_at' => Carbon::now('Asia/Manila'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'id' => '18',
                'title' => 'CLERK III',
                'created_at' => Carbon::now('Asia/Manila'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'id' => '19',
                'title' => 'COURIER',
                'created_at' => Carbon::now('Asia/Manila'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'id' => '20',
                'title' => 'DRIVER II',
                'created_at' => Carbon::now('Asia/Manila'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
            [
                'id' => '21',
                'title' => 'CHAUFFUER',
                'created_at' => Carbon::now('Asia/Manila'),
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ],
        ];

        PositionsLib::insert($data);
    }
}