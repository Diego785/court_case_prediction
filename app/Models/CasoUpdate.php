<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasoUpdate extends Model
{
    use HasFactory;
    protected $table = "caso_updates";
    public $timestamps = false;
    protected $guarded = ['id'];

    public function caso_updates()
    {
        return  $this->belongsTo(Caso::class, 'caso_id');
    }
}
