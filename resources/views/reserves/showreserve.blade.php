@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('reserves.reserve')
            </div>
            <div class="col-md-12">
                @include('invoices.invoice')
            </div>
        </div>
    </div>
@endsection