<?php

namespace Database\Factories\Order;

use App\Enums\VendorType;
use App\Models\Order\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vendor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company,
            'vendor_first_name' => $this->faker->firstName,
            'vendor_last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'location' => $this->faker->address,
            'website' => $this->faker->url,
            'remark' => $this->faker->text,
            'vendor_status' =>  $this->faker->randomElement(['Active', 'Inactive','Draft' ]),
            'vendor_type' => $this->faker->randomElement(['Wholesaler', 'Manufacturer','Individual']),
            'receivables' => $this->faker->numberBetween(1000, 3500),
            'used_credits' => $this->faker->numberBetween(1000, 3500),
        ];
    }
}

