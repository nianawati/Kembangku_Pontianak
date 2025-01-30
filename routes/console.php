<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('hash:password', function () {
    // Ask for password input
    $password = $this->ask('Please enter the password you want to hash');
    
    // Hash the password
    $hashedPassword = Hash::make($password);

    // Output the hashed password
    $this->info("Hashed Password: {$hashedPassword}");
})->purpose('Prompt for a password and hash it');
