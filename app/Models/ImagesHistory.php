<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesHistory extends Model
{

    use HasFactory;

    protected $table = 'images_history';
    protected $fillable = [
        'vin',
        'stock',
        'images',
        'is_available_inventory'
    ];


}
