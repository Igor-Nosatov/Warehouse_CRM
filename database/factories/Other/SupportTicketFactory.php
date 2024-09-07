<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\SupportTicketCategoryType;
use App\Enums\SupportTicketPriorityType;
use App\Enums\SupportTicketStatusType;
use App\Models\Auth\User;

class SupportTicketFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(SupportTicketStatusType::all()),
            'priority' => $this->faker->randomElement(SupportTicketPriorityType::all()),
            'category' => $this->faker->optional()->randomElement(SupportTicketCategoryType::all()),
            'user_id' => User::factory(),
            'closed_at' => $this->faker->optional()->dateTimeThisYear()->format('Y-m-d H:i:s'),
        ];
    }
}
