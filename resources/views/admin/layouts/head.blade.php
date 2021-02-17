
<!-- Favicon -->
<link rel="shortcut icon" href="{{asset('assets/images/favicon.ico') }}" type="image/x-icon" />




<link rel="stylesheet" href="{{asset('assets/css/plugins/toastr.css')}}" type="text/css">

@stack('css')



<!--- Style css -->
@if (App::getLocale() == 'en')
    <link href="{{ asset('assets/css/ltr.css') }}" rel="stylesheet">
@else
    <link href="{{asset('assets/css/rtl.css') }}" rel="stylesheet">
@endif


<!-- Font -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
<style>
    body{
        font-family: 'Cairo', sans-serif;
    }
</style>
