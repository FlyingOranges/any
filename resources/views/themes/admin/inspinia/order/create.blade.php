@extends('layouts.'.getTheme())
@section('css')
    <link href="{{asset(getThemeAssets('iCheck/custom.css', true))}}" rel="stylesheet">
    <style type="text/css">
        .iCheck-helper {
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background: rgb(255, 255, 255);
            border: 0;
            opacity: 0;
        }

        .radio-class {
            position: absolute;
            opacity: 0;
        }

        .i-checks {
            text-align: center;
            float: left;
            margin-left: 15px;
        }
    </style>
@endsection
@section('content')
    @inject('userPresenter','App\Repositories\Presenters\Admin\UserPresenter')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{!! trans('order.title') !!}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="javascript:;">{!! trans('order.title') !!}</a>
                </li>
                <li>
                    <a href="{{ route('order.index') }}">{!! trans('order.orderList') !!}</a>
                </li>
                <li class="active">
                    <strong>{!! trans('common.create').trans('order.slug') !!}</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <div class="title-action">
                <a class="btn btn-white" href="{{ route('order.index') }}">
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
                        <h5>{!! trans('common.create').trans('order.slug') !!}</h5>
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
                        <form method="post" action="{{ route('order.store') }}" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="form-group{{ $errors->has('copyright_figure') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">{{trans('order.copyright_figure')}}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="copyright_figure" value="{{old('copyright_figure')}}"
                                           placeholder="{{ trans('order.copyright_figure') }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block m-b-none text-danger">{{ $errors->first('copyright_figure') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group{{ $errors->has('serial_number') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">{{trans('order.serial_number')}}</label>
                                <div class="col-sm-10">
                                    <input type="tel" class="form-control" name="serial_number"
                                           value="{{old('serial_number')}}" placeholder="{{trans('order.serial_number')}}">
                                    @if ($errors->has('serial_number'))
                                        <span class="help-block m-b-none text-danger">{{ $errors->first('serial_number') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group{{ $errors->has('software_name') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">{{trans('order.software_name')}}</label>
                                <div class="col-sm-10">
                                    <input type="tel" class="form-control" name="software_name"
                                           value="{{old('software_name')}}" placeholder="{{trans('order.software_name')}}">
                                    @if ($errors->has('software_name'))
                                        <span class="help-block m-b-none text-danger">{{ $errors->first('software_name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group{{ $errors->has('deliveried_at') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">{{trans('order.deliveried_at')}}</label>
                                <div class="col-sm-10">
                                    <input type="tel" class="form-control" name="deliveried_at"
                                           value="{{old('deliveried_at')}}" placeholder="{{trans('order.deliveried_at')}}">
                                    @if ($errors->has('deliveried_at'))
                                        <span class="help-block m-b-none text-danger">{{ $errors->first('deliveried_at') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group{{ $errors->has('work_hours') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">{{trans('order.work_hours')}}</label>
                                <div class="col-sm-10">
                                    <input type="tel" class="form-control" name="work_hours"
                                           value="{{old('work_hours')}}" placeholder="{{trans('order.work_hours')}}">
                                    @if ($errors->has('work_hours'))
                                        <span class="help-block m-b-none text-danger">{{ $errors->first('work_hours') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">{{trans('order.price')}}</label>
                                <div class="col-sm-10">
                                    <input type="tel" class="form-control" name="price"
                                           value="{{old('price')}}" placeholder="{{trans('order.price')}}">
                                    @if ($errors->has('price'))
                                        <span class="help-block m-b-none text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-white"
                                       href="{{ route('order.index') }}">{!!trans('common.cancel')!!}</a>
                                    @if(haspermission('orderscontroller.store'))
                                        <button class="btn btn-primary"
                                                type="submit">{!! trans('common.create') !!}</button>
                                    @endif
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
    <script>
        $(document).ready(function () {

            $(".iradio_square-green").on('click', function () {
                $('.iradio_square-green').each(function (key, val) {
                    if ($(val).hasClass('checked')) {
                        $(val).removeClass('checked');
                    }
                });
            });


            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
@endsection