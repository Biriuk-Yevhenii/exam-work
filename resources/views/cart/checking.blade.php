@extends('layouts.app')

@section('content')
    <div class="contact-body my-4" >
        <div class="content" >
            <form action="https://www.liqpay.ua/api/3/checkout" method="POST">
                <input type="hidden" name="action" value="buyItNow">
                <input type="hidden" name="status" value="success">
                <input type="hidden" name="payment" value="0">

                <input type="hidden" name="name" value="{{$request->name}}">
                <input type="hidden" name="sec_name" value="{{$request->sec_name}}">
                <input type="hidden" name="sity" value="{{$request->sity}}">
                <input type="hidden" name="post_code" value="{{$request->post_code}}">
                <input type="hidden" name="tel" value="{{$request->tel}}">
                <input type="hidden" name="address" value="{{$request->address}}">
                <input type="hidden" name="email" value="{{$request->email}}">
                <input type="hidden" name="totalPrice" value="{{$request->totalPrice}}">
                <input type="hidden" name="quantity" value="{{$request->totalPrice}}">

                <h4 style="text-align: center">Check your details</h4>
                <h5 style="text-align: left">Name: {{$request->name}} {{$request->sec_name}}</h5>
                <h5 style="text-align: left">Adress: {{$request->country}}, {{$request->sity}}, {{$request->address}}, {{$request->post_code}}</h5>
                <h5 style="text-align: left">Phone: {{$request->tel}}</h5>
                <h5 style="text-align: left">Email: {{$request->email}}</h5>
                <div class="d-flex justify-content-around">
                    {!!$html!!} 
                </div>               
            </form>
                    
                
        </div>
    </div>
@endsection

@section('title')
    Otomow Cart 
@endsection