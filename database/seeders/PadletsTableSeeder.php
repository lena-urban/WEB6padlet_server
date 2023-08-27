<?php

namespace Database\Seeders;

namespace Database\Seeders;
use App\Models\Padlet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DateTime;
class PadletsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $padlet1 = new Padlet();
        $padlet1->title = 'Das erste Padlet';
        $padlet1->isPublic = 1;
        $padlet1->published = new DateTime();
        $padlet1->user_id = 1;
        $padlet1->save();

    }
}
