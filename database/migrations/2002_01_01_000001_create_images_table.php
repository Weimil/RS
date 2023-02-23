<?php

use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(Image::TABLE, function (Blueprint $table) {
            $table->id(Image::ID);
            $table->foreignId(Image::USER_ID)->constrained(User::TABLE);

            $table->string(Image::IMAGE_PATH)->nullable();
            $table->string(Image::DESCRIPTION)->nullable();

            $table->timestamp(Image::CREATED_AT)->nullable();
            $table->timestamp(Image::UPDATED_AT)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Image::TABLE);
    }
};
