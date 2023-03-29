<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\StatusSeeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Patient\Patient;
use App\Models\Appointment\Appointment;
use Hashids\Hashids;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create user/admin
        User::create(["name"=>"admin","password"=>Hash::make("abc123"),"email"=>"admin@test.com",'email_verified_at'=>now()]);

        // create patient
        Patient::create(["name"=>"ali", "ic_number"=>900201041234, "phone"=>"0171234567"]);

        $customAlphabet = implode('', range('A', 'Z')) . implode('', range('0', '9'));
        $hashids = new Hashids('', 6, $customAlphabet);
        $code = $hashids->encode(1);

        // create appointment
        Appointment::create(['code'=>$code, 'appointment_date'=>now(),'patient_id'=>1,'status_id'=>1]);

        //update status
        $this->call([
            StatusSeeder::class
        ]);
        
    }
}
