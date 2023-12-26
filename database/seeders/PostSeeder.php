<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    private static $keyContentSrc = "content_src";

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory()
            ->count(2)
            ->state(new Sequence(
                $this->createContentSrcSecVal(
                    'https://cdn.theatlantic.com/thumbor/fWHNkP-IHxWP4gyI87XDAaiKPFU=/0x62:2000x1187/976x549/media/img/mt/2018/03/AP_325360162607/original.jpg'
                ),
                $this->createContentSrcSecVal(
                    'https://i.natgeofe.com/n/9135ca87-0115-4a22-8caf-d1bdef97a814/75552.jpg'
                )
            ))
            ->create();
    }

    private function createContentSrcSecVal(string $src): array
    {
        return [PostSeeder::$keyContentSrc => $src];
    }

}
