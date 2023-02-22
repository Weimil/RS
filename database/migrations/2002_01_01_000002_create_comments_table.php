<?php

use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(Comment::TABLE, function (Blueprint $table) {
            $table->id(Comment::ID);
            $table->foreignId(Comment::USER_ID)->constrained(User::TABLE);
            $table->foreignId(Comment::IMAGE_ID)->constrained(Image::TABLE);

            $table->string(Comment::CONTENT);

            $table->timestamp(Comment::CREATED_AT)->nullable();
            $table->timestamp(Comment::UPDATED_AT)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Comment::TABLE);
    }
};
