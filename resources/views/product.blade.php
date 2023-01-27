@extends('layouts.app')

@section('content')
<div class="container" id="product">
    <h1 class="mb-3">Cloud Hosting Indonesia</h1>
    <div class="row">
        @if (isset($data['message']))
            <div class="alert alert-danger" role="alert">
                API error : {{ $data['message'] }}
            </div>
        @else
            @foreach ($items as $item)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">{{ $item['product_name'] }}</div>

                        <div class="card-body" style="text-align: right;">
                            <p class="card-text">{{ $item['pricing']['prefix'] }} {{ $item['pricing']['monthly'] }} {{ $item['pricing']['suffix'] }}</p>
                            <p style="margin-top: -16px; font-size: 12px;">Monthly</p>
                            <a href="/domain-register" class="btn btn-primary order-now" data-id="{{ $item['product_id'] }}">Order Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection