<?php

namespace App\Http\Controllers\Admin;

use App\Services\Admin\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
        $data = $this->OrderService->findByIdOrder($id);

        return view(getThemeView('order.show'), ['view' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->OrderService->findByIdOrder($id);

        return view(getThemeView('order.edit'), ['view' => $data]);
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

        $merge = $request->except(['_method', '_token']);

        $this->OrderService->updateOrder($id, $merge) ?
            flash('更新成功')->success() : flash("更新失败")->error();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->OrderService->destroyOrder($id) ?
            responseJson('删除成功') : responseJson('删除失败', [], 1);
    }

    public function import(Request $request)
    {
        $file = $request->file('import_file');

        $entension = $file->getClientOriginalExtension();
        if (!in_array($entension, ['xlsx', 'xls'])) {
            flash()->error('上传文件格式不正确,只接收xlsx,xls格式文件');
            return back();
        }

        $files = uploadFile($file);
        $data = $this->importFile($files);

        $uid = Auth::id();
        $create = [];
        if (is_array($data)) {
            foreach ($data as $key => &$item) {
                $create[$key] = [
                    'copyright_figure' => $item[0], 'serial_number' => $item[1],
                    'software_name' => $item[2], 'deliveried_at' => $item[3],
                    'out_at' => $item[4], 'work_hours' => $item[5],
                    'price' => $item[6], 'user_id' => $uid, 'created_at' => date('Y-m-d', time()),
                    'updated_at' => date('Y-m-d', time())
                ];
            }
        }

        //无论是否导入成功,均删除实体文件(excel)
        $file_path = public_path(iconv('UTF-8', 'GBK', $files));
        unlink($file_path);

        $this->OrderService->createBatchOrder($create) ? flash()->success('导入成功') : flash()->error('导入失败');

        return back();
    }

    private function importFile(string $path)
    {
        $filePath = '/public/' . iconv('UTF-8', 'GBK', $path);

        $data = Excel::load($filePath)->toArray();

        foreach ($data as $key => &$item) {
            $item = array_where($item, function ($value, $keys) {
                return $keys < 7;
            });
            if (!$item[0]) {
                unset($data[$key]);
            }
        }

        return $data;
    }

    public function export(Request $request)
    {
        $search = $request->get('search', '');
        $result = $this->OrderService->exportOrder($search);

        foreach ($result as &$item) {
            $item = array_values($item);
        }

        array_unshift($result,
            ['著作权人', '流水号', '软件名称', '交件日期', '出证日期', '工作日', '价格', '工作者']);

        Excel::create(date('Y-m-d H:i:s') . '账单', function ($excel) use ($result) {

            $excel->sheet('score', function ($sheet) use ($result) {
                $sheet->rows($result);
            });
        })->export('xlsx');
    }
}
