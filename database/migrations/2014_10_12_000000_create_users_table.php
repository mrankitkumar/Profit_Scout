<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['admin', 'user','company']); 
            $table->string('userdetail_id');
            $table->string('subadminrole_id')->nullable();
            $table->string('website_link')->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('mobile_number')->nullable();
            $table->boolean('isActive')->nullable();
            $table->string('gender')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable(); 
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->text('payment_information')->nullable(); 
            $table->rememberToken();
            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
