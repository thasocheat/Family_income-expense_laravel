<?php

use App\Helpers\Qs;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name');
            $table->string('username', 100)->nullable()->unique();
            $table->string('user_type')->default('parent');
            $table->string('code', 100)->nullable()->unique();
            $table->string('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('photo')->default(Qs::getDefaultUserImage());
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
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
