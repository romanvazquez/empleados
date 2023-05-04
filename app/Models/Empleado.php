<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = [
        'nombre',
        'ape_pat',
        'ape_mat',
        'fecha_nac',
        'telefono',
        'email',
        'no_empleado',
        'area',
        'puesto',
        'estatus',
        'fecha_contratacion',
        'salario',
        'user_id'
    ];

    public function scopeNombre($query, $keyWord)
    {
        if( empty($keyWord) ){
            return;
        }

        return $query->Where('nombre', 'like', $keyWord)
        ->orWhere('ape_mat', 'like', $keyWord)
        ->orWhere('ape_pat', 'like', $keyWord);
    }

    public function scopeEmail($query, $keyWord)
    {
        if( empty($keyWord) ){
            return;
        }

        return $query->orWhere('email', 'like', $keyWord);
    }

    public function scopeTelefono($query, $keyWord)
    {
        if( empty($keyWord) ){
            return;
        }

        return $query->orWhere('telefono', 'like', $keyWord);
    }

    public function scopePuesto($query, $keyWord)
    {
        if( empty($keyWord) ){
            return;
        }

        return $query->orWhere('puesto', 'like', $keyWord);
    }

    public function scopeNoEmpleado($query, $keyWord)
    {
        if( empty($keyWord) ){
            return;
        }

        return $query->orWhere('no_empleado', 'like', $keyWord);
    }
}
