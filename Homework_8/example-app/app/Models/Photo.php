<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
    use HasFactory;

    // Список полей, которые можно менять в базе данных
    protected $fillable = [
        'name', 'description','category_id'
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(PhotoCategoryModel::class, 'category_id');
    }
}
