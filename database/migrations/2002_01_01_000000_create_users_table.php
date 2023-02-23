<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(User::TABLE, function (Blueprint $table) {
            $table->id(User::ID);

            $table->string(User::NAME);
            $table->string(User::SURNAME);
            $table->string(User::EMAIL)->unique();
            $table->string(User::USER_NAME)->unique();
            $table->string(User::ROLE)->nullable();
            $table->string(User::PASSWORD);

            $table->timestamp(User::CREATED_AT)->nullable();
            $table->timestamp(User::UPDATED_AT)->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->rememberToken();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(User::TABLE);
    }
};
