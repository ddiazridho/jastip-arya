<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => "Arya Athoillah",
            'email' => "aryaathoillah@gmail.com",
            'password' => '12345678',
            'whatsapp_url' => "https://wa.me/+62881027304081",
            'instagram_url' => "https://www.instagram.com/aryaathoillah___/",
            'tiktok_url' => "https://www.tiktok.com/@aryaathoillah?_r=1&_t=ZS-99FYeGsypJl",
            'avatar_url' => "arya picture.jpeg",
            'role' => "Admin Jastip",
            'city' => "Bandung, Indonesia",
            'tagline' => "Credit where credit is due",
        ];
    }
}
