<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .notification {
            color: white;
            text-decoration: none;
            padding: 6px 6px;
            position: relative;
            display: inline-block;
            border-radius: 2px;
        }

        .notification:hover {
            background: #f8f8f8;
        }

        .notification .badge {
            position: absolute;
            top: -3px;
            right: -6px;
            padding: 6px 8px;
            border-radius: 50%;
            background-color: red;
            color: white;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li>
                                <a href="/review" class="notification">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <span class="badge"></span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('order') }}">
                                        {{ __('Order') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>
    var token = $("meta[name='csrf-token']").attr("content");

    $(document).ready(function() {
        var count = localStorage.getItem("count");
        var domain = localStorage.getItem("domain");
        const product = JSON.parse(localStorage.getItem("cart"));

        $('.badge').text(count);     

        var price = $(".select-billing").find('option').filter(':selected').data("value");
        var type = $(".select-billing").find('option').filter(':selected').val(); 

        $(".price").text(price);
        $(".billing-type").text(type);
        $(".nominal").text(price);
        $(".grand-total").text(price);

        $(".review-pname").text(product.product_name);
        $(".price").text(product.price);
        $(".total-price").text(product.price + " " + product.billing_type);
        $("#review-domain").val(domain)
        $("#review-type").val(product.billing_type);
        $("#review-pid").val(product.product_id);
    });

    $(".check-domain").click(function(e){
        e.preventDefault();

        var domain = $("#domain").val();
        var type = $("#type").val();
        var pid = localStorage.getItem("product_id");
        
        $.ajax({
            url: '/check-domain/' + domain + type,
            type: "post",
            dataType: 'json',
            data: {
                "_token": token
            },
            CrossDomain:true, 
            beforeSend: function(){
                // Show image container
                $("#loader_register_home").show();
            },
            success:function(response){
                if(response.result == 'error') {
                    $(".msg-error").show()
                    $(".msg-success").hide()
                    $(".msg-error").text(response.message)
                    $(".continue-checkout").addClass("disabled");
                } else if (!response.whois) {
                    $(".msg-error").hide()
                    $(".msg-success").show()
                    $(".msg-success").text("Result success, response empty")
                    $(".continue-checkout").removeClass("disabled");
                    localStorage.setItem("domain", domain + type);
                    $('.continue-checkout').attr('href', '/checkout/'+ pid)
                } else {
                    $(".msg-error").hide()
                    $(".msg-success").show()
                    $(".msg-success").text(response)
                    $(".continue-checkout").removeClass("disabled");
                    localStorage.setItem("domain", domain + type);
                    $('.continue-checkout').attr('href', '/checkout/'+ pid)
                }
            },
            complete:function(data){
                // Hide image container
                $("#loader_register_home").hide();
            }
        });
    });

    $(".continue-checkout").click(function(e) {

    });

    $(".select-billing").change(function(e) {
        var price = $(this).find('option').filter(':selected').data("value");
        var type = $(this).find('option').filter(':selected').val(); 
        
        $(".price").text(price);
        $(".billing-type").text(type);
        $(".nominal").text(price);
        $(".grand-total").text(price);
    });

    $(".create-invoice").click(function(e){

        var pid = $(".pid").val();
        var pname = $(".pname").text();
        var prefix = $(".prefix").val();
        var suffix = $(".suffix").val();
        var type = $(".select-billing").find('option').filter(':selected').val(); 
        var price = $(".select-billing").find('option').filter(':selected').data("value");

        const arr = {
            "product_id": pid, 
            "product_name": pname,
            "billing_type": type,
            "price": price,
            "prefix": prefix,
            "suffix": suffix
        }

        localStorage.setItem('cart', JSON.stringify(arr))

        var count = localStorage.getItem("count");
        if(!count) {
            count = 0;
        }
        var result = parseInt(count) + 1;

        localStorage.setItem("count", result);
        $('.badge').text(result);
    });
    
</script>
</html>
