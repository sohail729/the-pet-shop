<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentJsonRelations\HasJsonRelationships as HasJsonRelationships;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes, HasJsonRelationships;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_uuid',
        'title',
        'price',
        'description',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'json',
    ];


    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_uuid', 'uuid');
    }

    public function brand() {
        return $this->belongsTo(Brand::class, 'metadata->brand', 'uuid');
    }


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
                $model->uuid = Str::uuid()->toString();
        });
    }
}
