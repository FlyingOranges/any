@extends('layouts.'.getTheme())
@section('css')
    <link href="{{ asset(getThemeAssets('dataTables/datatables.min.css', true)) }}" rel="stylesheet">
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{!! trans('order.title') !!}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="javascript:void(0);">{!! trans('order.title') !!}</a>
                </li>
                <li class="active">
                    <strong>{!! trans('order.orderList') !!}</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <div class="title-action">
                @if(haspermission('usercontroller.create'))
                    <a href="{{ route('order.create') }}" class="btn btn-info">
                        <i class="fa fa-plus"></i> {!! trans('common.create').trans('order.slug') !!}
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>{!! trans('order.title') !!}</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        @include('flash::message')

                        <div id="dataTableBuilder_wrapper"
                             class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="row">
                                <div class="col-sm-6">
                                    <form action="">
                                        <div class="dataTables_length" id="dataTableBuilder_length">
                                            <label>
                                                搜索:
                                                <input type="search" class="form-control input-sm" name="search"
                                                       aria-controls="dataTableBuilder" value="{{ $search or '' }}">
                                            </label>

                                            <button class="btn btn-sm btn-primary">确定</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                           id="dataTableBuilder" role="grid" aria-describedby="dataTableBuilder_info">
                                        <thead>
                                        <tr role="row">
                                            <th>序号</th>
                                            <th>著作权人</th>
                                            <th>流水号</th>
                                            <th>软件名称</th>
                                            <th>交件日期</th>
                                            <th>工作日</th>
                                            <th>出证日期</th>
                                            <th>价格</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($data as $item)
                                            <tr role="row" class="odd">
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->copyright_figure }}</td>
                                                <td>{{ $item->serial_number }}</td>
                                                <td>{{ $item->software_name }}</td>
                                                <td>{{ $item->deliveried_at }}</td>
                                                <td>{{ $item->work_hours }}</td>
                                                <td>交件日期</td>
                                                <td>{{ $item->price }}</td>
                                                <td>
                                                    <a href="{{ route('order.show',['id'=>encodeId($item->id)]) }}"
                                                       class="btn btn-xs btn-info tooltips">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('order.edit',['id'=>encodeId($item->id)]) }}"
                                                       class="btn btn-xs btn-outline btn-warning tooltips">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:;"
                                                       class="btn btn-xs btn-outline btn-danger tooltips destroy_item">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="dataTables_paginate paging_simple_numbers"
                                         id="dataTableBuilder_paginate">
                                        {!! $data->appends(['search'=>$search])->links() !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset(getThemeAssets('dataTables/datatables.min.js', true))}}"></script>
    <script src="{{asset(getThemeAssets('layer/layer.js', true))}}"></script>
    <script type="text/javascript">
        $(document).on('click', '.destroy_item', function () {
            var _item = $(this);
            var title = "{{trans('common.deleteTitle').trans('order.slug')}}？";
            layer.confirm(title, {
                btn: ['{{trans('common.yes')}}', '{{trans('common.no')}}'],
                icon: 5
            }, function (index) {
                // _item.children('form').submit();
                layer.close(index);
            });
        });
    </script>
@endsection