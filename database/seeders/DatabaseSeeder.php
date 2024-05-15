<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CartItem;
use App\Models\DeliveryRegion;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Standard;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $regions = ['Все регионы', 'Беларусь'];
        foreach ($regions as $region) {
            DeliveryRegion::factory()
                ->create([
                    'name' => $region
                ]);
        }

        $standards = ['Все стандарты',
            'СТБ 1311-2002',
            'ГОСТ 8267-93',
            'ГОСТ 8267-94',
            'ГОСТ 8267-95',
            'ГОСТ 32703-2014',
            'ГОСТ 7392-2002',
            'ТУ BY 200161167.003-2010',
            'СТБ ЕН 13450-2007',
            'СТБ ЕН 12620-2010',
            'ТУ BY 200161167.004 – 2013',
            'ГОСТ 8736-93',
            'ТУ BY 200161167.003 – 2010',
            'СТБ 2318-2013',
            'ТУ BY 200161167.005-2015'];
        foreach ($standards as $standard) {
            Standard::factory()
                ->create([
                    'name' => $standard
                ]);
        }

        $this->call(ProductSeeder::class);

        $user = User::factory()
            ->create();

        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'edit orders']);
        $role->givePermissionTo($permission);
        $user->assignRole($role);

        UserAddress::factory(5)
            ->create();

        CartItem::factory(8)
            ->create();

        Order::factory(5)
            ->create();

        OrderItem::factory(40)
            ->create();

        Order::all()
            ->each(function ($order) {
                OrderItem::where('order_id', '=', $order->id)
                    ->each(function ($orderItem) use ($order) {
                        $order->update(['total_price' => round($order->total_price + $orderItem->total_price, 2)]);
                    });
            });
    }
}
