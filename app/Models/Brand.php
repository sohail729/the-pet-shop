<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Brand extends Model
{
    use SoftDeletes, HasFactory;
    
    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['title'];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'updated_at',
        'deleted_at',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
                $model->uuid = Str::uuid()->toString();
                $model->slug = Str::slug($model->title);
        });
        static::updating(function ($model) {
                $model->slug = Str::slug($model->title);
        });
    }
}
