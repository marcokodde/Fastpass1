<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientSession extends Model
{
    use HasFactory;
    protected $table = 'client_sessions';
    protected $fillable = [
        'client_id',
        'start_at',
        'expire_at',
        'active'
    ];

    /**+------------+
     * | Relaciones |
     * +------------+
     */

     public function client(){
         return $this->belongsTo(Client::class);
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

     public function scopeActive($query,$valor = true){
         $query->where('active',$valor);
     }


}
