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
    private $OrderModel;

    public function __construct(Order $orderModel)
    {
        $this->OrderModel = $orderModel;
    }

    public function index($searche)
    {
        return $this->OrderModel->getIndexLists(Auth::id(), $searche);
    }

    public function createOrder($create)
    {
        $create['user_id'] = Auth::id();

        return $this->OrderModel->create($create);
    }

    public function findByIdOrder($id)
    {
        return $this->OrderModel->getByIdOrder($id);
    }

    public function updateOrder($id, $merge)
    {
        return $this->OrderModel->updateOrder($id, $merge);
    }

    public function destroyOrder($id)
    {
        return $this->OrderModel->destroyOrder($id);
    }

    public function createBatchOrder($create)
    {
        return $this->OrderModel->batchCreate($create);
    }

    public function exportOrder($search)
    {
        return $this->OrderModel->getExportLists(Auth::id(), $search)->toArray();
    }


}