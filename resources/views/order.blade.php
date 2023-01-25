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






<div class="container" style="display:none;">
    <h1 class="mb-3">Configure</h1>
    <p>Configure your desired options and continue to checkout.</p>
    
    <form class="row">
        <div class="col-md-6">
            <div class="mb-3" style="background-color: #e8e8e8; width: auto;height: 58px;"></div>

            <span>Choose Billing Cycle</span>
            <select class="form-select" name="type">
                <option value=".com">.com</option>
                <option value=".net">.net</option>
                <option value=".org">.org</option>
                <option value=".biz">.biz</option>
                <option value=".info">.info</option>
            </select>
        </div>

        <div class="col-md-2"></div>
        <div class="col-md-4">
            <div class="mb-3" style="background-color: #e8e8e8; width: auto;height: 58px;">
                <h3 style="padding: 10px; text-align: center;">Order Summary</h3>
            </div>

            <p>Merdeka 1</p>
            <span>Cloud Hosting</span>
            <div class="row">
                <div class="col-md-7">
                    <span>Merdeka 1</span>
                </div>
                <div class="col-md-5" style="text-align: right;">
                    <span>Rp10,000 IDR</span>
                </div>
            </div>

            <hr/>
            <div class="row">
                <div class="col-md-7">
                    <span>Setup Fees:</span>
                </div>
                <div class="col-md-5" style="text-align: right;">
                    <span>Rp0 IDR</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <span>Monthly:</span>
                </div>
                <div class="col-md-5" style="text-align: right;">
                    <span>Rp10,000 IDR</span>
                </div>
            </div>

            <hr/>
            <div class="row">
                <div class="col-md-5">&nbsp;</div>
                <div class="col-md-7" style="text-align: right;">
                    <h2>Rp10,000 IDR</h2>
                    <p>Total Due Today</p>

                    <button type="submit" class="btn btn-primary mb-3">Continue</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection