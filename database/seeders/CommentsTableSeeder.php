<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DateTime;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $comment1 = new Comment();
        $comment1->text = 'Das ist ein Kommentar mit Rating';
        $comment1->rating = 4;
        $comment1->entry_id = 1;
        $comment1->user_id = 1;
        $comment1->save();


    }
}
