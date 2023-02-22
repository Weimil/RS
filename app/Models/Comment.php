<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    // ════════════════════════════════════════

    const TABLE = 'comments';

    const ID = 'id';
    const USER_ID = 'user_id';
    const IMAGE_ID = 'image_id';

    const CONTENT = 'content';

    const UPDATED_AT = 'updated_at';
    const CREATED_AT = 'created_at';

    // ════════════════════════════════════════

    protected $table = self::TABLE;

    // ════════════════════════════════════════

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class,self::IMAGE_ID);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,self::USER_ID);
    }
}
