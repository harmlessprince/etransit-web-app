<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewsletterSubscriber;

class NewsletterSubscriberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subscribersRecords = [
            ['id'=>1,'email'=>'cymoore24@gmail.com','status'=>1],
            ['id'=>2,'email'=>'email@gmail.com','status'=>1],
        ];

        NewsletterSubscriber::insert($subscribersRecords);
    }
}
