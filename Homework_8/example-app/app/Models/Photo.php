<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

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

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(PhotoTag::class,'pivot_photo_tags',
        'photo_id','tag_id');
    }

    protected static function boot() {
        parent::boot();

        static::saved(function ($model) {
           $request = request();
           $model->tags()->detach();
           $model->category()->associate($request->input('category_id'));
           if ($request->has('tags')){
               $model->tags()->attach($request->input('tags'));
           }
        });

        static::deleting(function($photo) {
            $photo->tags()->detach();

            if (Storage::exists($photo->url)){
                Storage::delete($photo->url);
            }
        });
    }
}
