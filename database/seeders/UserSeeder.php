<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

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
            ->count(3)
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

    }

    private function createAvatarSrcSecVal(string $src): array
    {
        return [UserSeeder::$keyAvatarSrc => $src];
    }
}
