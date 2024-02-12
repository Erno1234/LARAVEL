<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'name' => 'Alexa',
            'email' => 'alexa@gmail.com',
            'password' => Hash::make('blabla')
        ]);

        User::create([
            'name' => 'Pál',
            'email' => 'pal@gmail.com',
            'password' => Hash::make('ablab')
        ]);

        User::create([
            'name' => 'Jani',
            'email' => 'jani@gmail.com',
            'password' => Hash::make('blab')
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
