<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Image extends Model
{
    use HasFactory;

    // ════════════════════════════════════════

    const TABLE = 'images';

    const ID = 'id';
    const USER_ID = 'user_id';

    const IMAGE_PATH = 'image_path';
    const DESCRIPTION = 'description';

    const UPDATED_AT = 'updated_at';
    const CREATED_AT = 'created_at';

    // ════════════════════════════════════════

    protected $table = self::TABLE;

    // ════════════════════════════════════════

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,self::USER_ID);
    }
}
