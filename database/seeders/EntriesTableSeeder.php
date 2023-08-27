<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Entry;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DateTime;

class EntriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $entry1 = new Entry();
        $entry1->title = 'Der erste Entry';
        $entry1->text = 'Dieser Entry wurde von User 1 erstellt.';
        $entry1->published = new DateTime();
        $entry1->user_id = 1;
        $entry1->padlet_id = 2;
        $entry1->save();

        $entry2 = new Entry();
        $entry2->title = 'Der zweite Entry';
        $entry2->text = 'Dieser Entry wurde von User 1 erstellt.';
        $entry2->published = new DateTime();
        $entry2->user_id = 1;
        $entry2->padlet_id = 2;
        $entry2->save();


    }

}
