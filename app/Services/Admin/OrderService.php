<?php

namespace App\Services\Admin;

interface OrderService
{
    public function index($search);

    public function createOrder($create);

    public function findByIdOrder($id);

    public function updateOrder($id, $merge);

    public function destroyOrder($id);
}