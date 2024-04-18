<!DOCTYPE html>
<html>
<head>

{{--    @include('frontend.master.link-css')--}}
</head>
<body>
<h4>{{ $details['name'] }}</h4>
{{--<p>{{ $details['body'] }}</p>--}}
{{--<p>Thank you</p>--}}

    <!-- Start of PageContent -->
    <div class="page-content mb-10 pb-2">
        <div class="container">
            <div style=" padding: 10PX 10PX;font-size: 16PX;font-weight: bold;text-align: left;">
                <i class="fas fa-check"></i>
                @if(isset($details['body']) && !empty($details['body']))
                    <span>{{$details['body']}}. </span>
                    <span>click here to <a target="new" href="{{route('login')}}"><strong>Login</strong></a>&nbsp;</span>
                @else
                    <span>Thank you for joining us.</span>
                @endif

            </div>
            <!-- End of Order Success -->
            @if(isset($details['Password']) && !empty($details['Password']))
            <ul style="padding: 0;display: inline-flex;margin: 0 auto;list-style: none;margin-left: 65px;margin-top: 13px;">
                <li style="flex-grow: 1;padding: 5px;text-align: center;font-size: 15px;">
                    <label>Email</label>
                    <strong style="color: #333;display: block;">{{$details['Email']}}</strong>
                </li>

                <li style="flex-grow: 1;padding: 5px;text-align: center;font-size: 15px;">
                    <label>Type</label>
                    <strong style="color: #333;display: block;">{{$details['Type']}}</strong>
                </li>

                <li style="flex-grow: 1;padding: 5px;text-align: center;font-size: 15px;">
                    <label>Pass Code</label>
                    <strong style="color: #333;display: block;">{{$details['Password']}}</strong>
                </li>

            </ul>
        @endif
            <!-- End of Order View -->
        </div>
        @if(isset($details['Password']) && !empty($details['Password']))
        <span>click here to login <a target="new" href="{{route('login')}}"><strong>Login</strong></a>&nbsp;</span>
        @endif
    </div>

{{--@include('frontend.master.js')--}}
</body>

</html>
