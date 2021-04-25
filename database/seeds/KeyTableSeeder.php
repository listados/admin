<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Key;

class KeyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//create 2017-08-01 by Excellence Soft
        $faker = Faker::create();

        $cellPhone = $faker->addProvider(new \Faker\Provider\pt_BR\PhoneNumber($faker));
        $cpf = $faker->addProvider(new \Faker\Provider\pt_BR\Person($faker));

        for ($i=0; $i < 10; $i++) { 
        	 DB::table('keys')->insert([
	            'keys_type_immobile' => str_random(10),
	            'keys_ref_immobile' => str_random(5),	            
	            'keys_address' => $faker->streetName,
	            'keys_number' => $faker->buildingNumber,
	            'keys_complements' => $faker->secondaryAddress,
	            //'keys_district' => $faker->district,
	            'keys_city' => $faker->city,
	            'keys_id_user' => 10, 
	            'keys_finality' => 'Residencial',
	            'keys_delivery' => 'Não',
	            'keys_date_exit' => $faker->dateTimeInInterval($startDate = 'now', $interval = '- 5 days', $timezone = date_default_timezone_get()),
	            'keys_date_devolution' => $faker->dateTimeInInterval($startDate = 'now', $interval = '- 1 days', $timezone = date_default_timezone_get()), 
	            
	            'keys_key_number' => $faker->numberBetween($min = 10, $max = 250),
	            'keys_visitor_email' => $faker->freeEmail, 
	            'keys_visitor_phone_two' =>  $cellPhone,
	            'keys_visitor_name' => $faker->name, 
	            'keys_cpf' => $cpf,
	            'keys_status' => 'Em atraso',
	            'keys_status_immobile' => 0,
	            //'keys_devolution_return_date' => $faker->dateTimeAD($max = 'now', $timezone = date_default_timezone_get()) 
	            
	        ]);

        }
    }
}
