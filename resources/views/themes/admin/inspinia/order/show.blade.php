@extends('layouts.'.getTheme())
@section('css')
    <link href="{{asset(getThemeAssets('iCheck/custom.css', true))}}" rel="stylesheet">
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{!! trans('order.title') !!}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="javascript:;">{!! trans('home.title') !!}</a>
                </li>
                <li>
                    <a href="{{ route('order.index') }}">{!!trans('order.title')!!}</a>
                </li>
                <li class="active">
                    <strong>{!!trans('common.show').trans('order.slug')!!}</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <div class="title-action">
                <a class="btn btn-white" href="{{route('order.index')}}">
                    <i class="fa fa-reply"></i>
                    {!! trans('common.cancel') !!}
                </a>
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{!! trans('common.show').' 流水号 [ '.$view->serial_number.' ] '.trans('order.slug') !!}</h5>
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
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('order.copyright_figure')}}</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$view->copyright_figure}}</p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('order.serial_number')}}</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{ $view->serial_number }}</p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('order.software_name')}}</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$view->software_name}}</p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('order.deliveried_at')}}</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{$view->deliveried_at}}</p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('order.work_hours')}}</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{ $view->work_hours }} 工作日</p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('order.price')}}</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{ $view->price }}</p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('order.out_at')}}</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static">{{ $view->out_at ? $view->out_at : '暂未出证' }}</p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-white"
                                       href="{{route('order.index')}}">{!!trans('common.cancel')!!}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="{{asset(getThemeAssets('iCheck/icheck.min.js', true))}}"></script>
    <script type="text/javascript" src="{{asset(getThemeAssets('js/check.js'))}}"></script>
@endsection