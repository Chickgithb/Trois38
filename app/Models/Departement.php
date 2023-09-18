<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;
    protected $table='departements';
    protected $fillable=['name', 'phones', 'notes', 'added_by', 'updated_by', 'active', 'com_code', 'created_at', 'updated_at'];

    public function added(){
        return $this->belongsTo('\App\Models\Admin', 'added_by');
    }
    public function updatedby(){
        return $this->belongsTo('\App\Models\Admin', 'updated_by');
    }
}
