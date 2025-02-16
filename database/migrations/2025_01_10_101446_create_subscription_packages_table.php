<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('subscription_packages', function (Blueprint $table) {
            $table->id();
            $table->string('subscription_name'); 
            $table->enum('subscription_type', ['Annual', 'Monthly', 'Days']); 
            $table->string('price')->nullable(); 
            $table->string('interval_period')->nullable(); 
            $table->text('feature')->nullable(); 
            $table->text('description')->nullable(); 
            $table->boolean('isActive')->default(true); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_packages');
    }
};
