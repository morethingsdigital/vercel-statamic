<?php

namespace Morethingsdigital\VercelStatamic;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Log;
use Statamic\Facades\CP\Nav;
use Statamic\Facades\Permission;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $vite = [
        'input' => [
            'resources/js/addon.js',
            'resources/css/addon.css'
        ],
        'publicDirectory' => 'resources/dist',
    ];

    protected $routes = [
        'cp' => __DIR__ . '/../routes/cp.php'
    ];

    protected $publishables = [
        __DIR__ . '/../resources/svg' => 'svg',
    ];

    protected $viewNamespace = 'vercel-statamic';

    public function bootAddon()
    {
        $this->registerAddonConfig();
        $this->bootPermissions();
        $this->bootAddonNav();
        $this->registerBladeComponents();
    }

    protected function bootAddonNav(): self
    {
        $items = [];
        $items[] = [
            'key' => 'Deployments',
            'isActive' => Route::current() === 'vercel-statamic.deployments.index',
            'isDisabled' => false,
            'isPreview' => false,
            'route' => 'vercel-statamic.deployments.index'
        ];
        $items[] = [
            'key' => 'Aliase',
            'isActive' => Route::currentRouteName() === 'vercel-statamic.aliase.index',
            'isDisabled' => false,
            'isPreview' => false,
            'route' => 'vercel-statamic.aliase.index'
        ];
        $items[] = [
            'key' => 'Envs',
            'isActive' => Route::currentRouteName() === 'vercel-statamic.envs.index',
            'isDisabled' => false,
            'isPreview' => false,
            'route' => 'vercel-statamic.envs.index'
        ];

        $items[] = [
            'key' => 'Logs',
            'isActive' => Route::currentRouteName() === 'vercel-statamic.logs.index',
            'isDisabled' => true,
            'isPreview' => true,
            'route' => 'vercel-statamic.logs.index'
        ];

        $items[] = [
            'key' => 'Webhooks',
            'isActive' => Route::currentRouteName() === 'vercel-statamic.webhooks.index',
            'isDisabled' => true,
            'isPreview' => true,
            'route' => 'vercel-statamic.webhooks.index'
        ];

        Nav::extend(function ($nav) use ($items) {
            $childrens = [];

            foreach ($items as $item) {
                if (!$item['isDisabled']) $childrens[$item['key']] = cp_route($item['route']);
            }

            $nav->tools('Vercel')
                ->route(
                    'vercel-statamic.index'
                )
                ->icon('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 1155 1000"><path fill="#000" d="m577.344 0 577.346 1000H0L577.344 0Z"/></svg>')
                ->active('vercel')
                ->can('view vercel')
                ->children($childrens);
        });

        view()->share('vercelStatamicNavigationItems', $items);

        return $this;
    }

    protected function bootPermissions(): self
    {
        Permission::group('vercel-statamic', 'Vercel', function () {
            Permission::register('view vercel', function ($permission) {
                $permission
                    ->label('View Redirects')
                    ->children([
                        Permission::make('edit vercel')
                            ->label('Edit Vercel')
                            ->children([
                                Permission::make('create vercel')->label('Create Vercel'),
                                Permission::make('delete vercel')->label('Delete Vercel'),
                            ]),
                    ]);
            });
        });

        return $this;
    }

    protected function registerBladeComponents(): self
    {
        Blade::componentNamespace('Morethingsdigital\\VercelStatamic\\View\\Components', 'vercel-statamic');

        return $this;
    }

    protected function registerAddonConfig(): self
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/vercel.php', 'statamic.vercel');

        $this->publishes([
            __DIR__ . '/../config/redirect.php' => config_path('statamic/vercel.php'),
        ], 'statamic-vercel-config');

        return $this;
    }
}
