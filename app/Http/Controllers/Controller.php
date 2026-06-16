<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

abstract class Controller
{
    public function __construct()
    {
        $user = auth()->user();
        if (! $user) {
            return;
        }

        View::share('menus', [
            [
                'url' => route('dashboard'),
                'name' => __('menu.dashboard'),
                'icon' => 'bx-home-circle',
                'active' => Route::is('dashboard'),
                'available' => true,
            ],
            [
                'header' => __('menu.master_data'),
                'available' => $user->can('view_customer'),
            ],
            [
                'url' => route('customer.index'),
                'name' => __('menu.customer'),
                'icon' => 'bx-store',
                'active' => Route::is('customer.*'),
                'available' => $user->can('view_customer'),
            ],
            [
                'name' => __('menu.user_management'),
                'icon' => 'bx-briefcase-alt-2',
                'active' => Route::is('role.*') || Route::is('user.*'),
                'available' => $user->can('view_user') || $user->can('view_role'),
                'submenu' => [
                    [
                        'url' => route('user.index'),
                        'name' => __('menu.user'),
                        'active' => Route::is('user.*'),
                        'available' => $user->can('view_user'),
                    ],
                    [
                        'url' => route('role.index'),
                        'name' => __('menu.role'),
                        'active' => Route::is('role.*'),
                        'available' => $user->can('view_role'),
                    ],
                ],
            ],
            [
                'header' => __('menu.transaction'),
                'available' => $user->can('view_invoice'),
            ],
            [
                'name' => __('menu.invoice'),
                'icon' => 'bx-receipt',
                'active' => Route::is('invoice.*'),
                'available' => $user->can('view_invoice'),
                'submenu' => [
                    [
                        'url' => route('invoice.index'),
                        'name' => __('menu.invoice_list'),
                        'active' => Route::is('invoice.index'),
                        'available' => $user->can('view_invoice'),
                    ],
                    [
                        'url' => route('invoice.create'),
                        'name' => __('menu.invoice_create'),
                        'active' => Route::is('invoice.create'),
                        'available' => $user->can('create_invoice'),
                    ],
                ],
            ],
            [
                'header' => __('menu.my_setting'),
                'available' => true,
            ],
            [
                'name' => __('menu.account'),
                'icon' => 'bx-user',
                'active' => Route::is('account.*'),
                'available' => true,
                'submenu' => [
                    [
                        'url' => route('account.profile.edit'),
                        'name' => __('menu.profile'),
                        'active' => Route::is('account.profile.edit'),
                        'available' => true,
                    ],
                    [
                        'url' => route('account.password.edit'),
                        'name' => __('menu.delete_account'),
                        'active' => Route::is('account.password.edit'),
                        'available' => true,
                    ],
                ],
            ],
            [
                'name' => __('menu.financial_report'),
                'icon' => 'bx-bar-chart',
                'url' => route('laporan.index'),
                'active' => Route::is('laporan.*'),
                'available' => $user->can('view_report'),
            ],
            [
                'name' => 'Log Aktivitas',
                'icon' => 'bx-history',
                'url' => route('log.activity'),
                'active' => Route::is('log.activity'),
                'available' => $user->can('view_log_activity'),
            ],
        ]);
    }

    protected function successNotification(string $key, string $menu): array
    {
        return ['icon' => 'success', 'title' => __($menu), 'message' => __($key, ['menu' => __($menu)])];
    }

    protected function failNotification(string $key, string $menu): array
    {
        return ['icon' => 'error', 'title' => __($menu), 'message' => __($key, ['menu' => __($menu)])];
    }
}
