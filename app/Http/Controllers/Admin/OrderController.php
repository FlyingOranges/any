<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Services\Admin\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends BaseController
{
    private $OrderService;

    public function __construct(OrderService $orderService)
    {
        parent::__construct();

        $this->OrderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $result = $this->OrderService->index($search);

        return view(getThemeView('order.list'), ['data' => $result, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(getThemeView('order.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'copyright_figure' => 'required',
            'software_name' => 'required',
            'deliveried_at' => 'required',
            'work_hours' => 'required',
            'price' => 'required'
        ], [
            'copyright_figure.required' => '请填写著作人',
            'software_name.required' => '请填写软件名称',
            'deliveried_at.required' => '请填写交件日期',
            'work_hours.required' => '请填写工作日',
            'price.required' => '请填写价格参数'
        ]);

        $merge = $request->except('_token');

        $this->OrderService->createOrder($merge) ?
            flash('新增账单成功')->success() : flash("新增账单失败")->error();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd(Auth::user());
        dd('OrderController@show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
