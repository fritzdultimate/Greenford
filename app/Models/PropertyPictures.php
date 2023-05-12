<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyPictures extends Model
{
    use HasFactory;

    protected $primaryKey = 'property_id';
    protected $fillable = [
        'property_id',
        'picture_url',
    ];


    public function property() {
        return $this->belongsTo(Properties::class, 'property_id');
    }

}
