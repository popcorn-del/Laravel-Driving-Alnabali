@extends('admin.layouts.master')
@section('title') Cronjob @endsection
@section('page-title') {{__('cronjob')}} @endsection

@section('css')
@endsection
@section('content')
    <div class="content-warpper">
        <div class="row">
            <div class="col-12">
                <!--Bus List section -->
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{Session::get('success')}}
                                </div>
                            @endif
                            <form action="{{route('cronjob.start')}}" method="post">
                                @csrf
                                <button class="btn btn-success">{{__('Run Cronjob')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
@endsection

