<?php

namespace App\Services\Admin;

interface OrderService
{
    public function index($search);

    public function createOrder($create);
}