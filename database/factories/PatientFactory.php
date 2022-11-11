<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    protected $model = Patient::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $randomInt = random_int(1,20);
        return [
            'is_active'=>1,
            'age'=>random_int(10,80),
            'first_appointment_date'=>$this->faker->date('Y-m-d','now'),
            'last_appointment_date'=>$this->faker->date('Y-m-d','now'),
            'appointment_reminder_method'=>'Text',
            'appointment_attended'=>$randomInt,
            'appointment_booked'=>$randomInt,
            'appointment_cancelled'=>0,
            'converted_booking'=>0,
            'converted_sales'=>0,
            'date_of_enquiry'=>$this->faker->date('Y-m-d','now'),
            'gender'=>'Female',
            'clinic_id'=>$randomInt,
            'marketing_category_id'=>$randomInt,
            'marketing_source_id'=>$randomInt,
            'external_patient_id'=>$this->faker->unique()->numberBetween(1000, 10000000),
            'user_id'=>User::factory(),
            'first_invoice_date'=>$this->faker->date('Y-m-d','now'),
            'last_invoice_date'=>$this->faker->date('Y-m-d','now'),
            'phone_skype'=>$this->faker->phoneNumber(),
            'phone_mobile'=>$this->faker->phoneNumber(),
            'timestamp_created'=>now()
        ];
    }
}
