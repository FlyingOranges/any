<?php
/**
 * Tag
 *
 * Created by PhpStorm.
 * User: Flying Oranges
 * Date: 2019/1/8
 * Time: 1:22 PM
 */

namespace App\Services\Admin\Impl;

use App\Models\Order;
use App\Services\Admin\OrderService;
use Illuminate\Support\Facades\Auth;

class OrderServiceImpl implements OrderService
{
    public function index($searche)
    {
        $OrderModels = new Order();

        return $OrderModels->getIndexLists(Auth::id(), $searche);
    }

    public function createOrder($create)
    {
        $OrderModels = new Order();

        $create['user_id'] = Auth::id();

        return $OrderModels->create($create);
    }


}