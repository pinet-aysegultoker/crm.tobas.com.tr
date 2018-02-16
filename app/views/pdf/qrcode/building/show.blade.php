@extends('layouts.pdf')
@section('content')
<?php
    $building = Building::find($id);
    $apartments = Apartment::where('building_id', $id)->get();
?>
    <div class="pdf-content">
        <div class="container-fluid">
            <div class="row">
                @foreach($apartments as $apartment)
                    <div class="col-xs-6 pdf-border text-center">
                        <h2 class="text-center">{{ $apartment->number }}</h2>
                        {{ QrCode::size(256)->generate(route('pdf.apartment.show', $apartment->id)) }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection