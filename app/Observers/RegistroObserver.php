<?php

namespace App\Observers;

use App\Models\Request;
use Illuminate\Support\Facades\Auth;

class RegistroObserver
{
    public function creating(Request $registro)
    {
        $registro->user_id = Auth::id();
        $registro->last_modified_by = Auth::id();
    }

    public function updating(Request $registro)
    {
        $registro->last_modified_by = Auth::id();
    }

    public function saving(Request $registro)
    {
        $registro->last_modified_by = Auth::id();
    }
}