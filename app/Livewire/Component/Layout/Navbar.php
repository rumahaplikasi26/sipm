<?php

namespace App\Livewire\Component\Layout;

use App\Livewire\BaseComponent;
use Livewire\Component;

class Navbar extends BaseComponent
{
    public $menus = [];

    public function filterMenus()
    {
        $menus = [
            [
                'name' => 'Dashboard',
                'url' => '#',
                'route' => 'dashboard',
                'icon' => 'fas fa-tachometer-alt',
                'permissions' => ['dashboard.index'],
                'menus' => [
                    [
                        'name' => 'Dashboard Attendance',
                        'url' => route('dashboard'),
                        'route' => 'dashboard',
                        'icon' => 'fas fa-users',
                        'permissions' => ['dashboard.index']
                    ],
                    [
                        'name' => 'Dashboard Activity',
                        'url' => '#',
                        'route' => 'dahboard',
                        'icon' => 'fas fa-users-cog',
                        'permissions' => ['dashboard.index']
                    ],
                ]
            ],
            [
                'name' => 'Master Data',
                'icon' => 'fas fa-database',
                'permissions' => ['user.index', 'role.index', 'group.index', 'position.index', 'employee.index'],
                'url' => '#',
                'route' => '#',
                'menus' => [
                    [
                        'name' => 'User',
                        'url' => route('master.users'),
                        'route' => 'master.users',
                        'icon' => 'fas fa-users',
                        'permissions' => ['user.index', 'role.index']
                    ],
                    [
                        'name' => 'Group',
                        'url' => route('master.groups'),
                        'route' => 'master.groups',
                        'icon' => 'fas fa-users-cog',
                        'permissions' => ['group.index']
                    ],
                    [
                        'name' => 'Area',
                        'url' => route('master.areas'),
                        'route' => 'master.areas',
                        'icon' => 'fas fa-map-marker-alt',
                        'permissions' => ['area.index']
                    ],
                    [
                        'name' => 'Position',
                        'url' => route('master.positions'),
                        'route' => 'master.positions',
                        'icon' => 'fas fa-user-tag',
                        'permissions' => ['position.index']
                    ],
                    [
                        'name' => 'Employee',
                        'url' => route('master.employees'),
                        'route' => 'master.employees',
                        'icon' => 'fas fa-user-tie',
                        'permissions' => ['employee.index']
                    ],
                    [
                        'name' => 'Scope',
                        'url' => route('master.scopes'),
                        'route' => 'master.scopes',
                        'icon' => 'fas fa-tag',
                        'permissions' => ['scope.index']
                    ],
                    [
                        'name' => 'Category Dependency',
                        'url' => route('master.category-dependencies'),
                        'route' => 'master.category-dependencies',
                        'icon' => 'fas fa-chart-line',
                        'permissions' => ['category.dependency.index']
                    ],
                    [
                        'name' => 'Shift',
                        'url' => route('master.shifts'),
                        'route' => 'master.shifts',
                        'icon' => 'fas fa-clock',
                        'permissions' => ['shift.index']
                    ],
                ],
            ],
            [
                'name' => 'Attendance',
                'icon' => 'fas fa-clock',
                'permissions' => ['attendance.index'],
                'url' => route('attendance'),
                'route' => 'attendance'
            ],
            [
                'name' => 'Activity',
                'icon' => 'fas fa-tag',
                'permissions' => ['activity.index'],
                'url' => route('activity'),
                'route' => 'activity'
            ],
            [
                'name' => 'Daily Image',
                'icon' => 'fas fa-camera',
                'permissions' => ['collection.image.index'],
                'url' => route('collection.images'),
                'route' => 'collection.images'
            ],
            [
                'name' => 'Monitoring Present',
                'icon' => 'fas fa-check-square',
                'permissions' => ['monitoring.present.index'],
                'url' => route('monitoring.present'),
                'route' => 'monitoring.present'
            ],
            [
                'name' => 'Report',
                'icon' => 'fas fa-chart-line',
                'permissions' => ['activity.report.index', 'attendance.report.index'],
                'url' => '#',
                'route' => '#',
                'menus' => [
                    [
                        'name' => 'Report Activity',
                        'icon' => 'fas fa-chart-line',
                        'permissions' => ['activity.report.index'],
                        'url' => route('activity.report'),
                        'route' => 'activity.report.index'
                    ],
                    [
                        'name' => 'Report Attendance',
                        'icon' => 'fas fa-chart-line',
                        'permissions' => ['attendance.report.index'],
                        'url' => route('attendance.report'),
                        'route' => 'attendance.report.index'
                    ],
                ],
            ]
        ];

        $this->menus = array_filter($menus, function ($menu) {
            return $this->authUser->hasAnyPermission($menu['permissions']);
        });

        foreach ($this->menus as &$menu) {
            if (isset($menu['menus'])) {
                $menu['menus'] = array_filter($menu['menus'], function ($subMenu) {
                    return $this->authUser->hasAnyPermission($subMenu['permissions']);
                });

                foreach ($menu['menus'] as &$subMenu) {
                    if (isset($subMenu['menus'])) {
                        $subMenu['menus'] = array_filter($subMenu['menus'], function ($subSubMenu) {
                            return $this->authUser->hasAnyPermission($subSubMenu['permissions']);
                        });
                    }
                }
            }
        }
    }

    public function mount()
    {
        $this->filterMenus();
    }

    public function render()
    {
        return view('livewire.component.layout.navbar');
    }
}
