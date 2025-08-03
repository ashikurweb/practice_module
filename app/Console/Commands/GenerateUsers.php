<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class GenerateUsers extends Command
{
    protected $signature = 'generate:users {count=10 : Number of users to generate}';

    protected $description = 'Generate sample users with profile images';

    public function handle()
    {
        $count = (int) $this->argument('count');
        
        $this->info("Generating {$count} users with profile images...");

        // Sample names for variety
        $names = [
            'John Doe', 'Jane Smith', 'Mike Johnson', 'Sarah Wilson', 'David Brown',
            'Emily Davis', 'Robert Miller', 'Lisa Garcia', 'James Rodriguez', 'Maria Martinez',
            'Christopher Lee', 'Amanda Taylor', 'Daniel Anderson', 'Jessica Thomas', 'Matthew Jackson',
            'Ashley White', 'Joshua Harris', 'Stephanie Martin', 'Andrew Thompson', 'Nicole Garcia'
        ];

        // Sample profile images (using initials as fallback)
        $profileImages = [
            'profile1.jpg', 'profile2.jpg', 'profile3.jpg', 'profile4.jpg', 'profile5.jpg'
        ];

        for ($i = 0; $i < $count; $i++) {
            $name = $names[$i % count($names)];
            $email = strtolower(str_replace(' ', '.', $name)) . '@example.com';
            
            // Randomly decide if user has profile image or not
            $hasProfileImage = rand(0, 1) === 1;
            $profileImage = $hasProfileImage ? $profileImages[array_rand($profileImages)] : null;

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'profile_image' => $profileImage,
            ]);

            $this->line("✅ Created user: {$user->name} ({$user->email})");
        }

        $this->info("🎉 Successfully generated {$count} users!");
        $this->info("You can now view them at: /admin/users");
        
        return Command::SUCCESS;
    }
} 