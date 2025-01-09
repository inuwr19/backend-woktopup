<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('games')->insert([
            ['name' => 'Mobile Legends', 'description' => 'Mobile Legends: Bang Bang is multiplayer online battle arena (MOBA) game designed for mobile phones. The game is free-to-play and is only monetized through in-game purchases like characters and skins. Each player can control a selectable character, called a Hero, with unique abilities and traits.', 'image' => 'https://mrwallpaper.com/images/hd/mobile-legends-logo-on-blue-background-2m7kdws7prybsvmt.jpg', 'status' => 'available'],
            ['name' => 'Genshin Impact', 'description' => 'Genshin Impact is an open-world, action role-playing game that allows the player to control one of four interchangeable characters in a party. Switching between characters can be done quickly during combat, allowing the player to use several different combinations of skills and attacks.', 'image' => 'https://i.ytimg.com/vi/fIuhg0bjvQI/maxresdefault.jpg', 'status' => 'unavailable'],
            ['name' => 'PUBG Mobie', 'description' => 'PUBG MOBILE is the original battle royale game on mobile and one of the best mobile shooting games. Prepare your firearms, respond to the call for battle in PUBG MOBILE, and fire at will. PUBG MOBILE has many maps and gameplay mechanics that give you a thrilling survival experience.', 'image' => 'https://www.charlieintel.com/cdn-image/wp-content/uploads/2021/01/53f7d969762523414600a6549e36202a.jpg?width=1200&quality=60&format=auto', 'status' => 'available'],
        ]);
    }
}
