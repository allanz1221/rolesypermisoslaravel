<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'marca',
        'modelo',
        'noserie',
        'noactivo',
        'numfactura',
        'ubicacion',
        'costo',
        'foto',
        'estado',
        'ocupado',
        'description',
        'quantity',
    ];

    public function requests()
    {
        return $this->belongsToMany(Request::class)->withPivot('quantity')->withTimestamps();
    }


    protected $casts = [
        'estado' => 'string',
        'ocupado' => 'string',
    ];

    /**
     * Obtiene la foto del material.
     *
     * @return string
     */
    public function getFotoUrlAttribute()
    {
        return $this->foto ? asset('storage/' . $this->foto) : null;
    }

    /**
     * Verifica si el material está disponible.
     *
     * @return bool
     */
    public function isAvailable()
    {
        return $this->ocupado === 'no';
    }
}
