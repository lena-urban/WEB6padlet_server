<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Padlet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DateTime;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user1 = new User();
        $user1->firstName = 'Lena';
        $user1->lastName = 'Urban';
        $user1->role = 'admin';
        $user1->url =
            "https://images-na.ssl-images-amazon.com/images/I/61h%2BnIJyVFL._SX333_BO1,204,20
        3,200_.jpg";
        $user1->username = 'lena-urban';
        $user1->pssword = bcrypt('secret');
        $user1->save();


        $user2 = new User();
        $user2->firstName = 'Bernhard';
        $user2->lastName = 'Krah';
        $user1->role = 'user';
        $user2->url =
            "https://images-eu.ssl-images-amazon.com/images/I/516KV5tjulL._AC_US327_FMwebp_QL
        65_.jpg";
        $user2->username = 'bernhard-krah';
        $user2->password = bcrypt('secret');
        $user2->save();


        $user3 = new User();
        $user3->firstName = 'Max';
        $user3->lastName = 'Mustermann';
        $user3->url =
            "https://images-eu.ssl-images-amazon.com/images/I/516KV5tjulL._AC_US327_FMwebp_QL
        65_.jpg";
        $user3->username = 'public-user';
        $user3->password = bcrypt('secret');
        $user3->save();



    }
}
