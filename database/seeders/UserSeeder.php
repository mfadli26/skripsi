<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $digits = 17;
        for ($i = 0; $i < 50; $i++) {
            $faker = Faker::create('id_ID');
            $gender = $faker->randomElement(['pria', 'wanita']);
            DB::table('users')->insert([
                'id' => (string) Str::orderedUuid(),
                'name' => $faker->name,
                'ktp_number' => rand(pow(10, $digits - 1), pow(10, $digits) - 1),
                'phone_number' => $faker->phoneNumber,
                'sex' => $gender,
                'birth_city' => $faker->cityName,
                'birth_date' => date("Y-m-d H:i:s", rand(1262055681, 1262055681)),
                'address' => $faker->address,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('test1234'),
                'admin' => 0,
                'created_at' => Carbon::now()
            ]);
        }
    }
}
