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
        Schema::create('user_subscription_histories', function (Blueprint $table) {
            $table->id();
            $table->string('subscription_id');
            $table->string('payment_method_id')->nullable();
            $table->string('customber_id');
            $table->string('start_date');
            $table->string('end_date')->nullable();
            $table->string('payment_date')->nullable();
            $table->string('ammount')->nullable();
            $table->string('invoice')->nullable();
            $table->string('payment_method')->nullable();
            $table->enum('subscription_status', ['Active', 'Inactive', 'Cancelled']); 
            $table->enum('payment_status', ['Success', 'Failed']); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_subscription_histories');
    }
};
