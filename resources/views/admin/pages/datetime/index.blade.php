@extends('admin.layouts.master')
@section('title') {{__('datetime')}} @endsection
@section('page-title') {{__('datetime')}} @endsection

@section('css')
@endsection
@section('content')
    <div class="content-warpper">
        <div class="row text-center">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif
        </row>     
        <form class="custom-validation" action="{{route('datetime.save')}}" id="custom-form" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('datetype')}}</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" name="date_format"
                                                    id="status_1" value="1" {{$data->date_format == 1 ? "checked" : ""}}>
                                                <label class="form-check-label" for="status_1">
                                                    dd/mm/yyyy
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight" type="radio" name="date_format"
                                                    id="status_1" value="1" {{$data->date_format == 1 ? "checked" : ""}}>
                                                <label class="form-check-label labelRight" for="status_1">
                                                    dd/mm/yyyy
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" name="date_format"
                                                    id="status_2" value="0" {{$data->date_format == 0 ? "checked" : ""}}>
                                                <label class="form-check-label" for="status_2">
                                                    mm/dd/yyyy
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight" type="radio" name="date_format"
                                                    id="status_2" value="0" {{$data->date_format == 0 ? "checked" : ""}}>
                                                <label class="form-check-label" for="status_2">
                                                    mm/dd/yyyy
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('timezone')}}</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning mb-3">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" name="time_format"
                                                    id="status_1" value="1" {{$data->time_format == 1 ? "checked" : ""}}>
                                                <label class="form-check-label" for="status_1">
                                                    GMT+3
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight" type="radio" name="time_format"
                                                    id="status_1" value="1" {{$data->time_format == 1 ? "checked" : ""}}>
                                                <label class="form-check-label labelRight" for="status_1">
                                                    GMT+3
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-radio-warning">
                                                @if(Session::get('lang') != 'jor')
                                                <input class="form-check-input" type="radio" name="time_format"
                                                    id="status_2" value="0" {{$data->time_format == 0 ? "checked" : ""}}>
                                                <label class="form-check-label" for="status_2">
                                                    GMT+2
                                                </label>
                                                @else
                                                <input class="form-check-input radioRight" type="radio" name="time_format"
                                                    id="status_2" value="0" {{$data->time_format == 0 ? "checked" : ""}}>
                                                <label class="form-check-label" for="status_2">
                                                    GMT+2
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="button-group">
                <button type="submit" class="btn btn-primary waves-effect waves-light" id="submit">{{__('save')}}</button>
            </div>
        </form>
    </div>
@endsection

