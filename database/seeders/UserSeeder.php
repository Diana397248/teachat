<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    private static $keyAvatarSrc = "avatar_src";

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(15)
            ->state(new Sequence(
                $this->createAvatarSrcSecVal(
                    'https://i.pinimg.com/736x/11/13/f6/1113f62b818e33f88264df5494694b1a.jpg'
                ),
                $this->createAvatarSrcSecVal(
                    'https://cs13.pikabu.ru/post_img/2023/02/16/5/1676527609275171634.jpg'
                ), $this->createAvatarSrcSecVal(
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRqMuLAiwRNWW_p8UFJRGxbp7mstcX0VB-f0PXtoEun1Z9a7wGos_i2-NnOjX71eVA37nY&usqp=CAU'
            )))
            ->create();
        User::factory()
            ->create([
                'name' => 'admin',
                'last_name' => 'admin',
                'email' => 'admin@mail.ru',
                'email_verified_at' => now(),
                'avatar_src' => 'https://cdn-icons-png.flaticon.com/512/2206/2206368.png',
                'password' => '$2y$10$SmnhGYq4yihSO1rOtvCGDOOKGIWry7Ul0kwzmvSLDxpNSPxA/M9Xa', // password 123
                'remember_token' => Str::random(10),
            ]);
    }

    private function createAvatarSrcSecVal(string $src): array
    {
        return [UserSeeder::$keyAvatarSrc => $src];
    }
}
