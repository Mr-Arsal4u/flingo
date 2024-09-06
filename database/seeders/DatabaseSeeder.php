<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(15)->create();

        // Conversation::create([
        //     'user1_id' => 1,
        //     'user2_id' => 2,
        // ]);

        // Message::create([
        //     'conversation_id' => 1,
        //     'sender_id' => 1,
        //     'message' => 'Hello',
        // ]);
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
