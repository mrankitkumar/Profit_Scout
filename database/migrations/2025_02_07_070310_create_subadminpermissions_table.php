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
        Schema::create('subadminpermissions', function (Blueprint $table) {
            $table->id();
            $table->string('permissionsname');
            $table->string('adminid');
            $table->boolean('isAdd')->default(true); 
            $table->boolean('isView')->default(true); 
            $table->boolean('isEdit')->default(true); 
            $table->boolean('isDelete')->default(true); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subadminpermissions');
    }
};
