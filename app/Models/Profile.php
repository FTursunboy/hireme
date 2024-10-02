<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'category_id', 'phone', 'min_service_cost', 'user_id', 'service_description', 'state', 'status', 'archived', 'archived_at'];

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category() :BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
