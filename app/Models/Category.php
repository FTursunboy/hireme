<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'parent_id'];


    public function parentCategory() :BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
