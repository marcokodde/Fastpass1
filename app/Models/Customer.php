<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable =  [
        'locator_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'source_id',
        'reason_id',
        'attention_mode',
        'check_in',
        'shift',
        'check_out',
    ];



    // Setters y Getters
    public function setFirstNamehAttribute($value)
    {
        $this->attributes['first_name'] =  ucwords(strtolower($value));
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] =  ucwords(strtolower($value));
    }

    public function getFullNameAttribute()
    {
        return ucwords($this->last_name) . ' ' .  ucwords($this->first_name);
    }


    /*+-----------------+
      | Relaciones      |
      +-----------------+
     */

    public function locator(){
        return $this->belongsTo(Locator::class);
    }

    public function source(){
        return $this->belongsTo(Source::class);
    }


    public function reason(){
        return $this->belongsTo(Reason::class);
    }


    /*+-----------------+
      | Funciones Apoyo |
      +-----------------+
     */


    public function can_be_delete(){
        return true;
    }


    /*+-------------------+
      | Búsquedas         |
      +-------------------+
    */

    public function scopeName($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('first_name','LIKE',"%$valor%")
                  ->orwhere('last_name','LIKE',"%$valor%");
         }
    }

    public function scopeEmail($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('email','LIKE',"%$valor%");
         }
    }

    public function scopePhone($query,$valor)
    {
        if ( trim($valor) != "") {
            $query->where('phone','LIKE',"%$valor%");
         }
    }

    public function scopeLocatorId($query,$valor){
        if($valor){
            $query->where('locator_id',$valor);
        }
    }

    public function scopeSourceId($query,$valor){
        if($valor){
            $query->where('source_id',$valor);
        }
    }

    public function scopeReasonId($query,$valor){
        if($valor){
            $query->where('reason_id',$valor);
        }
    }

    public function scopeAttentionMode($query,$valor){
        if($valor){
            $query->where('attention_mode',$valor);
        }
    }

    public function scopeSeller($query,$valor){
        $query->where('attention_mode','Seller');
    }

    public function scopeOnline($query,$valor){
        $query->where('attention_mode','Online');
    }


}


