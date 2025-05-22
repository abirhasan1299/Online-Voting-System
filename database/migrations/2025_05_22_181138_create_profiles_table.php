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
        Schema::create('profiles', function (Blueprint $table) {

            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('fname');
            $table->string('lname');
            $table->string('photo',1000);
            $table->string('nid_no');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('present_address',1000);
            $table->string('permanent_address',1000);
            $table->string('profession');
            $table->string('educational_qualification');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
