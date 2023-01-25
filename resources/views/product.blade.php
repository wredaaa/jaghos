@extends('layouts.app')

@section('content')
<div class="container" id="product">
    <h1 class="mb-3">Cloud Hosting Indonesia</h1>
    <div class="row">
        @foreach ($data['products']['product'] as $product)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">{{ $product['name'] }}</div>

                    <div class="card-body" style="text-align: right;">
                        <p class="card-text">{{ $product['pricing']['IDR']['prefix'] }} {{ $product['pricing']['IDR']['monthly'] }} {{ $product['pricing']['IDR']['suffix'] }}</p>
                        <p style="margin-top: -16px; font-size: 12px;">Monthly</p>
                        <a href="/domain-register" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection