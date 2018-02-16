@extends('layouts.common')
@section('title', 'CRM')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                @include('widgets.monthly-meetings-report')
            </div>
            <div class="col-md-4">
                @include('widgets.customers-report')
            </div>
            <div class="col-md-4">
                @include('widgets.reminders')
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1>Toplam Blok Sayısı:</h1></div>
                    <div class="panel-body">
                        <div class="alert alert-success" role="alert">
                            <h1 class="text-center">{{ Building::where('status','!=','removed')->count() }} BLOK</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1>Toplam Konut Sayısı:</h1></div>
                    <div class="panel-body">
                        <div class="alert alert-success" role="alert">
                            <h1 class="text-center">{{ Apartment::where('status','!=','removed')->count() }} KONUT</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1>Müsait Konut Sayısı:</h1></div>
                    <div class="panel-body">
                        <div class="alert alert-success" role="alert">
                            <h1 class="text-center">{{ Apartment::where('status','active')->count() }} KONUT</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <a class="" href="{{route('sales.index')}}">
                <div class="panel panel-crm">
                    <div class="panel-heading"><h1>Satılmış Konut Sayısı:</h1></div>
                    <div class="panel-body">
                        <div class="alert alert-success" role="alert">
                            <h1 style="text-decoration: none!important;" class="text-center">{{ Apartment::where('status','passive')->count() }} KONUT</h1>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('widgets.buildings-report')
            </div>
        </div>
    </div>
@endsection