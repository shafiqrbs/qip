<!DOCTYPE html>
<html>
<head>

    @include('frontend.master.link-css')
</head>
<body>
<h4>{{ $details['name'] }}</h4>
{{--<p>{{ $details['body'] }}</p>--}}
{{--<p>Thank you</p>--}}

<!-- Start of PageContent -->
<div class="page-content mb-10 pb-2">
    <div class="container">
        <div style=" padding: 10PX 10PX;font-size: 16PX;font-weight: bold;text-align: left;">
            <h3>Password Reset Code</h3>
            <i class="fas fa-check"></i>
            @if(isset($details['resetcode']) && !empty($details['resetcode']))
                <span>{{$details['resetcode']}}. </span>
{{--                <span>click here to <a target="new" href="{{route('login')}}"><strong>Login</strong></a>&nbsp;</span>--}}
            @endif

        </div>

    <!-- End of Order View -->
    </div>

</div>

@include('frontend.master.js')
</body>

</html>
