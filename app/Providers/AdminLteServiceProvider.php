<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use App\Models\Request; // Asume que tienes un modelo Request
use Illuminate\Support\Facades\Auth;

class AdminLteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app['events']->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $user = Auth::user();
            
            if ($user) {
                $pendingRequestsCount = Request::where('user_id', $user->id)
                                               ->where('status', 'pending')
                                               ->count();

                $event->menu->add([
                    'text' => 'Material de laboratorio',
                    'url' => 'requests',
                    'icon' => 'far fa-fw fa-file',
                    'label' => $pendingRequestsCount,
                    'label_color' => 'success',
                ]);
            }
        });
    }
}