<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Locator extends Model
{
    use HasFactory;
    protected $table = 'locators';
    public $timestamps = false;
    protected $fillable =  [
        'name'
    ];

    // Setters
    public function setNameAttribute($value)
    {
        $this->attributes['name'] =  ucwords(strtolower($value));
    }


    /*+-----------------+
      | Relaciones      |
      +-----------------+
     */

    public function customers(){
        return $this->hasMany(Customer::class);
    }

    public function customers_by_shift(){
        return $this->hasMany(Customer::class)->orderby('shift');
    }

    public function customers_pending(){
        return $this->hasMany(Customer::class)->whereNull('chek_out')->orderby('shift');
    }

    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */



    public function can_be_delete(){
        if($this->customers()->count()){ return false;}
        return true;
    }

    /*+-------------------+
      | Búsquedas         |
      +-------------------+
    */


    public function scopeName($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('name','LIKE',"%$valor%");
         }
    }


}
