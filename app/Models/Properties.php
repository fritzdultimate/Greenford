<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Properties extends Model {
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'location',
        'status',
        'type',
        'size',
        'baths',
        'rooms',
        'beds',
        'garages',
        'year_built',
        'lot_area',
        'home_area',
        'lot_dimention',
        'price',
        'description',
        'youtube_video',
        'video_tour',
        'slug',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function property_pictures() : HasMany
    {
        return $this->hasMany(PropertyPictures::class, 'property_id');
    }
}
