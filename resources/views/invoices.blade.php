@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Review & Checkout</h1>
    
    <form method="POST" action="/submit-order" class="row">
        @csrf
        <div class="col-md-6">
            <div class="mb-3" style="background-color: #e8e8e8; width: auto;height: 58px;">
                <p style="padding: 19px;" class="review-pname"></p>
            </div>
            <input type="text" name="firstname" placeholder="first name">
            <input type="text" name="lastname" placeholder="last name">
            <input type="text" name="email" placeholder="email">
            <input type="text" name="address" placeholder="address">
            <input type="text" name="city" placeholder="city">
            <input type="text" name="state" placeholder="state">
            <input type="text" name="postcode" placeholder="postcode">
            <input type="text" name="country" placeholder="country">
            <input type="text" name="phonenumber" placeholder="phonenumber">
            <input type="password" name="password" placeholder="password">
            <input type="text" name="clientip" placeholder="clientip">
            <input type="hidden" name="domain" id="review-domain">
            <input type="hidden" name="billing_type" id="review-type">
            <input type="hidden" name="pid" id="review-pid">

             <select class="form-select mt-3" id="select-payment" name="paymentmethod">
                @foreach ($paymentMethod['paymentmethods']['paymentmethod'] as $item)
                        <option value="{{ $item["module"] }}">{{ $item['displayname'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2"></div>
        <div class="col-md-4">
            <div class="mb-3" style="background-color: #e8e8e8; width: auto;height: 58px;">
                <h3 style="padding: 10px; text-align: center;">Order Summary</h3>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <span>Subtotal</span>
                </div>
                <div class="col-md-5" style="text-align: right;">
                    <span class="price"></span>
                </div>
            </div>

            <hr/>
            <div class="row">
                <div class="col-md-5">
                    <span>Total:</span>
                </div>
                <div class="col-md-7" style="text-align: right;">
                    <span class="total-price"></span>
                </div>
            </div>

            <hr/>
            <div class="row">
                <div class="col-md-5">&nbsp;</div>
                <div class="col-md-7" style="text-align: right;">
                    <h2 class="price"></h2>
                    <p>Total Due Today</p>

                    <button type="submit" class="btn btn-primary mb-3">Checkout</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection