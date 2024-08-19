<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status','materia','last_modified_by'];

    public function materials()
    {
        return $this->belongsToMany(Material::class)->withPivot('quantity')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function lastModifiedBy()
    {
        return $this->belongsTo(User::class, 'last_modified_by');
    }
    
}
