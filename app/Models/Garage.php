<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Garage extends Model
{
    use HasFactory;
    protected $table = 'garages';
    protected $fillable = [
        'client_id',
    ];


    // Detalle de garages
    public function vehicles_in_garages(): HasMany
    {
        return $this->hasMany(DetailGarage::class);
    }

    /**+------------+
     * | Apoyo      |
     * +------------+
     */

     public function has_space(){
        return $this->vehicles_in_garages->count() < ENV('GARAGE_SPACES');
     }

     public function available_spaces(){
         return ENV('GARAGE_SPACES') - $this->vehicles_in_garages->count();
     }

    /**+------------+
     * | Búsquedas  |
     * +------------+
     */

     public function scopeClientId($query,$valor){
        if(trim($valor) != ""){
            $query->where('client_id',$valor);
        }
     }

}
