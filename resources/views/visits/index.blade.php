@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <table id="visitsTable" data-url="{{ route('visits') }}" class="table table-bordered table-white" width="100%">
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
    </div>
@endsection

@section('scripts')
    <script>
        var deleteUserUrl = '{{route('visits.delete',['id' => 'id'])}}';
    </script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.1/toastr.min.js"></script>
    <script src="{{ asset('js/visitors.js') }}" defer></script>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    <link href="{{ asset('css/visitors.css') }}" rel="stylesheet">
@endsection
