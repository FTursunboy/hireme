<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfileCategory extends Model
{
    use HasFactory;
    protected $table = 'profile_categories';
    protected $fillable = ['profile_id', 'category_id'];

    public function profile() :BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function category() :BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
