<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{asset('frontend/css/bootstrap5.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/custom.css')}}" rel="stylesheet"> 

    <!-- owl Carousel -->
    <link href="{{asset('frontend/css/owl.carousel.min.css')}}" rel="stylesheet"> 
    <link href="{{asset('frontend/css/owl.theme.default.min.css')}}" rel="stylesheet"> 

    <!-- autocompletesearch -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

    <style>
        a{
            text-decoration: none !important;
        }
    </style>
</head>

<body>
    @include('layouts.inc.frontnavbar')
    <div class="content">
                @yield('content')
    </div>

    <div class="watsapp-chat">
        <a href="https://wa.me/+923049350926?text=I'm%20interested%20in%20your%20product%20for%20sale" target="_blank">
            <img src="{{asset('assets/images/watsapp-icon.png')}}" height="60px" width="60px" alt="watsapp-logo">
        </a>
    </div>
    <!-- Jquery JS-->
    <script src="{{asset('frontend/js/jquery-3.6.0.min.js')}}"></script>

    <script src="{{asset('frontend/js/custom.js')}}"></script>

    <!-- Main JS-->
    <script src="{{asset('frontend/js/bootstrap5.js')}}"></script>

    <script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>

    <script src="{{asset('frontend/js/checkout.js')}}"></script>

    <!--Start of Tawk.to Script-->
<!-- <script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/62d31e997b967b117999de71/1g84b4a2a';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script> -->
<!--End of Tawk.to Script-->

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
    var availableTags = [];
$.ajax({
    method: "GET",
    url: "/product-list",
    success: function (response) {
        //console.log(response);
        startAutoComplete(response)  
    }
});
function startAutoComplete(availableTags)
{
    $( "#search_product" ).autocomplete({
      source: availableTags
    });
}
  
  </script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if(session('status'))
    <script>
        swal("{{session('status')}}");
    </script>
    @endif
@yield('scripts')
</body>

</html>
<!-- end document-->