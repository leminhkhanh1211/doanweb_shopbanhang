<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Roles;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<Admin>
 */
class AdminFactory extends Factory
{
    protected $model = Admin::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'admin_name' => fake()->name(),
            'admin_email' => fake()->unique()->safeEmail(),
            'admin_phone' => '0932023992',
            'admin_password' => 'e10adc3949ba59abbe56e057f20f883e', // Mật khẩu được hash
            // 'admin_role_id' => Roles::factory()->create()->id,
        ];
    }

    /**
     * Configure the factory.
     *
     * @return $this
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Admin $admin) {
            $roles = Roles::where('name', 'user')->pluck('id_roles')->toArray();
            $admin->roles()->sync($roles); // Liên kết các roles với admin
        });
    }
}

