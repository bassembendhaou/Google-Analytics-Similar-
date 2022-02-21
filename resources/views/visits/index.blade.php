@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="col-md-12 row mb-4">
                    <div class="col-md-3">
                        <select class="form-select" id="deviceType">
                            <option value="" selected>@lang('messages.device')</option>
                            @foreach (array_flip(\App\Models\Visit::DEVICE_TYPE) as $key => $value)
                                <option value="{{$key}}">@lang('messages.'.$value)</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                    {{--    <select class="users form-select">
                            <option value="3620194" selected="selected">select2/select2</option>
                        </select>--}}
                    </div>
                </div>
                <table id="visitsTable"  class="table table-dark table-striped" data-url="{{ route('visits') }}" width="100%">
                    <thead>
                    <tr>
                        <th>@lang('messages.id')</th>
                        <th>@lang('messages.user')</th>
                        <th>@lang('messages.url')</th>
                        <th>@lang('messages.ip')</th>
                        <th>@lang('messages.country')</th>
                        <th>@lang('messages.device')</th>
                        <th>@lang('messages.browser')</th>
                        <th>@lang('messages.created_at')</th>
                        <th>@lang('messages.actions')</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var deleteVisitUrl = '{{route('visits.delete',['id' => 'id'])}}';
        var usersUrl = '{{route('visits.users')}}';
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.1/toastr.min.js"></script>
    <script src="{{ asset('js/visitors.js') }}" defer></script>
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
    <link href="{{ asset('css/visitors.css') }}" rel="stylesheet">
@endsection
