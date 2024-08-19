<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material_requests extends Model
{
    use HasFactory;
    protected $table = "material_request";

    protected $fillable = ['request_id', 'material_id', 'quantity'];

}
