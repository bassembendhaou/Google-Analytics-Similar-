@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table id="usersTable" class="table table-dark table-striped" data-url="{{ route('users') }}" width="100%">
                    <thead>
                    <tr>
                        <th>@lang('messages.id')</th>
                        <th>@lang('messages.name')</th>
                        <th>@lang('messages.email')</th>
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
        var deleteUserUrl = '{{route('users.delete',['id' => 'id'])}}';
    </script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.1/toastr.min.js"></script>
    <script src="{{ asset('js/users.js') }}" defer></script>
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
    <link href="{{ asset('css/users.css') }}" rel="stylesheet">
@endsection
