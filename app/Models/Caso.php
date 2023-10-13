<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caso extends Model
{
    use HasFactory;
    protected $table="casos";
    public $timestamps = true;
    protected $guarded=['id','created_at','updated_at'];


    public function caso_updates()
    {
        return $this->hasMany(CasoUpdate::class, 'caso_id');
    }
}
