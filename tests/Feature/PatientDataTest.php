<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Laravel\Passport\Passport;

class PatientDataTest extends TestCase
{
    // use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install');
        $this->seed();
        $user = User::factory()->create();
        Passport::actingAs($user);
        $this->withoutExceptionHandling();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_patient()
    {
        $response = $this
            ->getJson(route('patients.show', ['external_id' => 86374]));

        $response->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json
                    ->has('patient_id')
                    ->has('first_appointment_id')
                    ->has('invoice')
                    ->has('total_receipts')
                    ->has('receipts')
                    ->has('first_receipt_date')
                    ->has('first_invoice_date')
                    ->has('first_appointment_date')
                    ->has('patient_created_date')
                    ->etc()
            );
    }
}
