<?php

use Illuminate\Database\Seeder;
use App\Survey;
use Faker\Factory as Faker;

class SurveyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create in 2016-07-22 15:22 by Junior Oliveira

    	$faker = Faker::create();

    	for ($i=0; $i < 10; $i++) {
		  Survey::create([
		  	'survey_locator_name' => $faker->name(),
            'survey_locator_cpf' => $faker->randomNumber(),
            'survey_occupant_name' =>  $faker->name(),
            'survey_occupant_cpf' => $faker->randomNumber(),
            'survey_inspetor_name' => $faker->name(),
            'survey_inspetor_cpf' => $faker->randomNumber(),
            'survey_date' => $faker->dateTimeThisCentury($max = 'now'),
            'survey_type' => $faker->word(),
            'survey_address_immobile' => $faker->secondaryAddress(),
            'survey_type_immobile' => $faker->word(),
            'survey_energy_meter' => $faker->randomFloat(),
            'survey_energy_load' => $faker->randomFloat(),
            'survey_water_meter' => $faker->randomFloat(),
            'survey_water_load' => $faker->randomFloat(),
            'survey_gas_meter' => $faker->randomFloat(),
            'survey_gas_load' => $faker->randomFloat(),
		  ]);
		}

       
    }
}
