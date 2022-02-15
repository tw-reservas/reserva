<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Paquete;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use PhpParser\Node\Stmt\Foreach_;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            // Add some items to the menu...
            $event->menu->add('MENU DE NAVEGACION');
            $rol = Auth::user()->rolUser;
            $response = DB::select("select pa.id,pa.nombre,pa.icon,cu.id as caso_id,cu.nombre as caso_nombre,cu.url
            from paquetes pa, caso_de_usos cu, menus me, rols r
            where pa.id = cu.paquete_id and cu.id = me.caso_de_uso_id
            and me.rol_id = r.id and r.id = ?
            order by(pa.id)", [$rol->id]);
            $menu = [];
            $i = 0;
            while ($i < count($response)) {
                $text = $response[$i]->nombre;
                $icon = $response[$i]->icon;
                $id = $response[$i]->id;
                $children = [];
                for ($j = $i; $j < count($response) && $id == $response[$j]->id; $j++) {

                    $subChildren = [
                        'text' => $response[$j]->caso_nombre,
                        'url'  => $response[$j]->url,
                    ];
                    array_push($children, $subChildren);
                    $i = $j;
                }
                $head = [
                    'text'    => $text,
                    'icon'    =>  $icon,
                    'submenu' => $children,
                ];
                $i += 1;
                array_push($menu, $head);
            }
            $event->menu->add(...$menu);
        });
    }
}
