<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [

        'name',
        'slug',
        'status',
        'is_delete',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'created_by',
    ];


    protected $casts = [
        'status' => 'boolean',
        'is_delete' => 'boolean',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function subCategories(): HasMany
{
    return $this->hasMany(SubCategory::class, 'category_id');
}
}
