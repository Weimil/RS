<?php

use App\Models\Image;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(Like::TABLE, function (Blueprint $table) {
            $table->id(Like::ID);
            $table->foreignId(Like::USER_ID)->constrained(User::TABLE);
            $table->foreignId(Like::IMAGE_ID)->constrained(Image::TABLE);

            $table->timestamp(User::CREATED_AT)->nullable();
            $table->timestamp(User::UPDATED_AT)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Like::TABLE);
    }
};
