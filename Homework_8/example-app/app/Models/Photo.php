<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Photo extends Model
{
    use HasFactory;

    // Список полей, которые можно менять в базе данных
    protected $fillable = [
        'name', 'description', //'category_id'
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(PhotoCategoryModel::class, 'category_id');
    }

    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(PhotoTag::class,'pivot_photo_tags',
        'photo_id','tag_id');
    }

    protected static function boot() {
        parent::boot();
        static::deleting(function($photo) {
            $photo->tags()->detach();
        });
    }
}
