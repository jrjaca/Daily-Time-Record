<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     [
        //         'name' => 'Virgilio M. Jaca Jr.',
        //         'email' => 'virgilio_jacajr@yahoo.com',
        //         'password' => Hash::make('11111111'),
        //     ]
        // ]);

        DB::table('users')->delete();
        $data = [
            [//1
                'employee_id' => '1',
                'employee_no' => '20556408',
                'last_name' => 'Jaca',
                'first_name' => 'Virgilio',
                'middle_name' => 'Mendoza',
                'suffix_name' => 'Jr.',
                'email' => 'virgilio_jacajr@yahoo.com',
                'pro_id' => '1',
                'branchunit_id' => '1',
                'lhiosection_id' => '2',
                'express_id' => null,
                'password' => Hash::make('11111111'),
                'activated' => '1',
                'created_at' => Carbon::now('Asia/Manila'),
            ],
        ];

        User::insert($data);
    }
}
