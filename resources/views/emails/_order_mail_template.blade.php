<!DOCTYPE html>
<html>
<head>

    @include('frontend.master.link-css')
</head>
<body>
<h4>{{ $details['welcome'] }}</h4>
{{--<p>{{ $details['body'] }}</p>--}}
{{--<p>Thank you</p>--}}

@if(isset($details['OrderData']) && !empty($details['OrderData']))
    <!-- Start of PageContent -->
    <div class="page-content mb-10 pb-2">
        <div class="container">
            <div style=" padding: 10PX 10PX;border: 1px solid #e1e1e1;font-size: 20PX;font-weight: bold;text-align: center;">
                <i class="fas fa-check"></i>
                Thank you. Your order has been received.
            </div>
            <!-- End of Order Success -->

            <ul style="padding: 0;display: inline-flex;margin: 0 auto;list-style: none;margin-left: 65px;margin-top: 13px;">
                <li style="flex-grow: 1;padding: 5px;text-align: center;font-size: 15px;">
                    <label>Order number</label>
                    <strong style="color: #333;display: block;">{{$details['OrderData']->order_number}}</strong>
                </li>
                <li style="flex-grow: 1;padding: 5px;text-align: center;font-size: 15px;">
                    <label>Status</label>
                    <strong style="color: #333;display: block;">
                        <?php
                        if ($details['OrderData']->status == '1'){
                            $status = 'Process';
                        }elseif ($details['OrderData']->status == '2'){
                            $status = 'Confirm';
                        }elseif ($details['OrderData']->status == '3'){
                            $status = 'Pending';
                        }elseif ($details['OrderData']->status == '4'){
                            $status = 'Approved';
                        }else{
                            $status = 'Return';
                        }
                        ?>
                        {{$status}}</strong>
                </li>
                <li style="flex-grow: 1;padding: 5px;text-align: center;font-size: 15px;">
                    <label>Date</label>
                    <strong style="color: #333;display: block;">

                        {{date('h:i:s a m/d/Y', strtotime($details['OrderData']->created_at))}}
                    </strong>
                </li>
                <li style="flex-grow: 1;padding: 5px;text-align: center;font-size: 15px;">
                    <label>Total Amount</label>
                    <strong style="color: #333;display: block;">{{$details['OrderData']->total_amount}}</strong>
                </li>
                <li style="flex-grow: 1;padding: 5px;text-align: center;font-size: 15px;">
                    <label>Payment method</label>
                    <strong style="color: #333;display: block;">{{$details['OrderData']->payment_method}}</strong>
                </li>
            </ul>
            <!-- End of Order View -->


                <h4 style="font-size: 20PX;font-weight: bold;text-align: center;">Order Details</h4>
                <table width="100%" style="margin: 0 auto;padding: .6rem 3rem 3rem;
border: 1px solid #e1e1e1;border-collapse: separate;">
                    <thead>
                    <tr>
                        <th style="border-bottom: 1px solid #e1e1e1;
font-size: 20px;text-align: left;
color: #333 !important;">Product</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($details['OrderData']->OrderProductItem as $value)
                        <tr>
                            <td style="text-align: left;
    min-width: 16rem;
    padding-top: 1rem;
    padding-bottom: 0;
    font-size: 15px;">
                                <a target="new" href="{{route('single.product.details',$value['slug'])}}">{{$value->name}}</a>&nbsp;<strong>( {{$value->quantity}} * {{$value->unit_price}})</strong><br>
                            </td>
                            <td style="text-align: right;    min-width: 16rem;
    padding-top: 1rem;
    padding-bottom: 0;
    font-size: 15px;">{{$value->subtotal}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th style="border-bottom: 1px solid #e1e1e1;
                        font-size: 20px;text-align: left;
                        color: #333 !important;">Amount</th>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th  style="text-align: left;    min-width: 16rem;
    padding-top: 1rem;
    padding-bottom: 0;
    font-size: 15px;">Subtotal:</th>
                        <td style="text-align: right;    min-width: 16rem;
    padding-top: 1rem;
    padding-bottom: 0;
    font-size: 15px;">{{$details['OrderData']->product_amount}}</td>
                    </tr>
                    <tr>
                        <th  style="text-align: left;    min-width: 16rem;
    padding-top: 1rem;
    padding-bottom: 0;
    font-size: 15px;">Deleviry Charge:</th>
                        <td style="text-align: right;    min-width: 16rem;
    padding-top: 1rem;
    padding-bottom: 0;
    font-size: 15px;">{{$details['OrderData']->delivery_charge}}</td>
                    </tr>
                    <tr class="total">
                        <th style="text-align: left;    min-width: 16rem;
    padding-top: 1rem;
    padding-bottom: 0;
    font-size: 15px;">Total:</th>
                        <td style="text-align: right;    min-width: 16rem;
    padding-top: 1rem;
    padding-bottom: 0;
    font-size: 15px;">{{$details['OrderData']->total_amount}}</td>
                    </tr>
                    </tfoot>
                </table>

<h4 style="font-size: 20px;font-weight: bold;text-align: center;">Billing/Shipping Address</h4>
            <div style="display: inline-flex;width: 100%;">
            <table width="50%" style="padding: 15px 15px;
border: 1px solid #e1e1e1;border-collapse: separate;">
                <tbody>
                @foreach($details['OrderData']->OrderBillingShipping as $value)
                    @if($value->type == 'billing')
                        <tr>
                            <th colspan="2" style="font-size: 18px;">Billing</th>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <th>{{$value->firstname.' '.$value->lastname}}</th>
                        </tr>

                        <tr>
                            <th>Mobile</th>
                            <th>{{$value->phone}}</th>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <th>{{$value->email}}</th>
                        </tr>

                        <tr>
                            <th>Address</th>
                            <th>{{$value->address}}</th>
                        </tr>

                        <tr>
                            <th>District</th>
                            <th>{{$value->district}}</th>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <th>{{$value->country}}</th>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>


            <table width="50%" style="padding: 15px 15px;
border: 1px solid #e1e1e1;border-collapse: separate;">
                <tbody>
                @foreach($details['OrderData']->OrderBillingShipping as $value)
                    @if($value->type == 'shipping')
                        <tr>
                            <th colspan="2" style="font-size: 18px;">Shipping</th>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <th>{{$value->firstname.' '.$value->lastname}}</th>
                        </tr>

                        <tr>
                            <th>Mobile</th>
                            <th>{{$value->phone}}</th>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <th>{{$value->email}}</th>
                        </tr>

                        <tr>
                            <th>Address</th>
                            <th>{{$value->address}}</th>
                        </tr>

                        <tr>
                            <th>District</th>
                            <th>{{$value->district}}</th>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <th>{{$value->country}}</th>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            </div>
{{--<table width="100%" style="margin: 0 auto;padding: 15px 15px;--}}
{{--border: 1px solid #e1e1e1;border-collapse: separate;">--}}
{{--<tbody>--}}
{{--    <tr>--}}
{{--        <th>Type</th>--}}
{{--        <th>Name</th>--}}
{{--        <th>Country</th>--}}
{{--        <th>District</th>--}}
{{--        <th>Address</th>--}}
{{--        <th>Mobile</th>--}}
{{--        <th>Email</th>--}}
{{--    </tr>--}}
{{--@foreach($details['OrderData']->OrderBillingShipping as $value)--}}
{{--    <tr>--}}
{{--        <td>{{$value->type}}</td>--}}
{{--        <td>{{$value->firstname.' '.$value->lastname}}</td>--}}
{{--        <td>{{$value->country}}</td>--}}
{{--        <td>{{$value->district}}</td>--}}
{{--        <td>{{$value->address}}</td>--}}
{{--        <td>{{$value->phone}}</td>--}}
{{--        <td>{{$value->email}}</td>--}}
{{--    </tr>--}}
{{--@endforeach--}}
{{--</tbody>--}}
{{--</table>--}}


@endif
@include('frontend.master.js')
</body>

</html>
