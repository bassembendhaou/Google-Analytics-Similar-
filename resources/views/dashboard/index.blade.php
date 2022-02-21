@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-3 widget-content">
                    <canvas id="myChart" width="400" height="400"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3 widget-content bg-midnight-bloom">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading mb-2">{{__('messages.total_number')}}</div>
                            <div class="widget-heading">{{__('messages.unique_number')}}</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white mb-2"><span>{{$data['nbVisits']}}</span></div>
                            <div class="widget-numbers text-white"><span>{{$data['nbVisitsUnique']}}</span></div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3 widget-content bg-midnight-bloom">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading mb-2">{{__('messages.total_number')}}</div>
                            <div class="widget-heading">{{__('messages.unique_visit_count_for_desktop')}}</div>
                            <div class="widget-heading">{{__('messages.unique_visit_count_for_tablet')}}</div>
                            <div class="widget-heading">{{__('messages.unique_visit_count_for_smartphone')}}</div>

                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white mb-2"><span>{{$data['nbVisits']}}</span></div>
                            <div class="widget-numbers text-white"><span>{{$data['deviceTypeStats']['nbrVisitsUniqueDesktop']}}</span></div>
                            <div class="widget-numbers text-white"><span>{{$data['deviceTypeStats']['nbrVisitsUniqueTablet']}}</span></div>
                            <div class="widget-numbers text-white"><span>{{$data['deviceTypeStats']['nbrVisitsUniqueSmartphone']}}</span></div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3 widget-content bg-midnight-bloom">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading mb-2">{{__('messages.total_number')}}</div>
                            <div class="widget-heading">{{__('messages.unique_visit_count_per_browser')}}</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white mb-2"><span>{{$data['nbVisits']}}</span></div>
                            <div class="widget-numbers text-white"><span>{{$data['nbVisitsUniquePerBrowser']}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var visitsCount = {!! json_encode($visitsCount) !!};
        var uniqueVisitsCount = {!! json_encode($uniqueVisitsCount) !!};
        var labels = {!! json_encode($labels) !!};
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/dashboard.js') }}" defer></script>
@endsection

@section('styles')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endsection
