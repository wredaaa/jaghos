@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Choose a Domain...</h1>
    
    <form id="submit-domain" class="row g-3">
        <div class="col-auto">
            <div class="input-group mb-2 mr-sm-2 mr-1">
                <div class="input-group-prepend">
                    <div class="input-group-text">www.</div>
                </div>
                <input type="text" class="form-control" id="domain" name="domain" placeholder="Enter your domain">                    
            </div>
        </div>
        
        <div class="col-auto">
            <select class="form-select" id="type" name="type">
                <option value=".com">.com</option>
                <option value=".net">.net</option>
                <option value=".org">.org</option>
                <option value=".biz">.biz</option>
                <option value=".info">.info</option>
            </select>
        </div>
        
        <div class="col-auto">
            <button class="btn btn-primary mb-3 check-domain">Check</button>
        </div>
    </form>

    <div id='loader_register_home' style="display:none;">
        <img src='{{ url('assets/img/loader.gif') }}' width='32px' height='32px'>
    </div>

    <div class="col-auto">
        <p style="color:red;">wreda.com is unavailable</p>
        <p>Congratulations! <strong><i>ajhdaljkd.com</i></strong> is available! Continue to register this domain for Rp15 IDR</p>
        <button class="btn btn-primary mb-3 continue-checkout">Continue</button>
    </div>
</div>

@endsection
