@extends('layouts.app')

@section('content')
{{-- <div class="container" id="product">
    <h1 class="mb-3">Order & Checkout</h1>
    <div class="row">
        @foreach ($data['products']['product'] as $product)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">{{ $product['name'] }}</div>

                    <div class="card-body" style="text-align: right;">
                        <p class="card-text">{{ $product['pricing']['IDR']['prefix'] }} {{ $product['pricing']['IDR']['monthly'] }} {{ $product['pricing']['IDR']['suffix'] }}</p>
                        <p style="margin-top: -16px; font-size: 12px;">Monthly</p>
                        <button class="btn btn-primary order-now">Order Now</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="container" id="domain" style="display:none;">
    <h1 class="mb-3">Choose a Domain...</h1>
    
    <form class="row g-3">
        <div class="col-auto">
            <div class="input-group mb-2 mr-sm-2 mr-1">
                <div class="input-group-prepend">
                    <div class="input-group-text">www.</div>
                </div>
                <input type="text" class="form-control" id="domain" placeholder="Enter your domain">                    
            </div>
        </div>
        
        <div class="col-auto">
            <select class="form-select" name="type">
                <option value=".com">.com</option>
                <option value=".net">.net</option>
                <option value=".org">.org</option>
                <option value=".biz">.biz</option>
                <option value=".info">.info</option>
            </select>
        </div>
        
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Check</button>
        </div>
    </form>

    <div class="col-auto">
        <p style="color:red;">wreda.com is unavailable</p>
        <p>Congratulations! <strong><i>ajhdaljkd.com</i></strong> is available! Continue to register this domain for Rp15 IDR</p>
        <button type="submit" class="btn btn-primary mb-3">Continue</button>
    </div>
</div>




 --}}

<div class="container">
    <h1 class="mb-3">Configure</h1>
    <p>Configure your desired options and continue to checkout.</p>
    
    <form class="row">
        <div class="col-md-6">
            <div class="mb-3" style="background-color: #e8e8e8; width: auto;height: 58px;">
                <input type="hidden" class="pid" value="{{ $product['products']['product'][0]['pid'] }}" />
                <input type="hidden" class="prefix" value="{{ $product['prefix'] }}" />
                <input type="hidden" class="suffix" value="{{ $product['suffix'] }}" />
                <p class="pname" style="padding: 19px;">{{ $product['products']['product'][0]['name'] }}</p>
            </div>

            <span>Choose Billing Cycle</span>
            <select class="form-select select-billing" id="select-billing" name="type">
                @foreach ($product['billing_type'] as $key => $value)
                    <option value="{{ $key }}" data-value="{{ $product['prefix'] }}{{ $value }}{{ $product['suffix'] }}" >{{ $product['prefix'] }}{{ $value }}{{ $product['suffix'] }} {{ $key }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2"></div>
        <div class="col-md-4">
            <div class="mb-3" style="background-color: #e8e8e8; width: auto;height: 58px;">
                <h3 style="padding: 10px; text-align: center;">Order Summary</h3>
            </div>

            <p>{{ $product['products']['product'][0]['name'] }}</p>
            <span>{{ $product['products']['product'][0]['type'] }}</span>
            <div class="row">
                <div class="col-md-7">
                    <span>{{ $product['products']['product'][0]['name'] }}</span>
                </div>
                <div class="col-md-5" style="text-align: right;">
                    <span class="price"></span>
                </div>
            </div>

            <hr/>
            <div class="row">
                <div class="col-md-7">
                    <span>Setup Fees:</span>
                </div>
                <div class="col-md-5" style="text-align: right;">
                    <span>{{ $product['prefix'] }} 0.00 {{ $product['suffix'] }} </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <span class="billing-type"></span>:
                </div>
                <div class="col-md-5" style="text-align: right;">
                    <span class="nominal"></span>
                </div>
            </div>

            <hr/>
            <div class="row">
                <div class="col-md-5">&nbsp;</div>
                <div class="col-md-7" style="text-align: right;">
                    <h2 class="grand-total"></h2>
                    <p>Total Due Today</p>

                    <a href="/review" class="btn btn-primary mb-3 create-invoice">Checkout</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection