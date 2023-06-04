@extends('layouts.app')

@section('content')
    {{-- <h1>History {{$user->name}}</h1>
    <table class="table" style="color: #ffffff">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th>Payed</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->buys as $buy)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td><img style="width: 100px" src="{{$buy->cart->product->image}}" alt="{{$buy->cart->product->title}}"></td>
                <td>{{$buy->cart->product->title}}</td>
                <td>{{$buy->cart->quantity}}</td>
                <td>{{$buy->cart->product->price}}$</td>
                <td>{{$buy->cart->product->price*$buy->cart->quantity}}$</td>
                <td>{{$buy->payment? 'Paid' : 'Unpaid'}}</td>
                
               
                
            </tr>
            @endforeach
        </tbody>
    </table>  --}}
    <div class="table-responsive ">
        <table class="table table-striped" style="color: #ffffff;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th>Payment Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->buys as $buy)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img style="width: 100px" src="{{ $buy->cart->product->image }}" alt="{{ $buy->cart->product->title }}"></td>
                    <td>{{ $buy->cart->product->title }}</td>
                    <td>{{ $buy->cart->quantity }}</td>
                    <td>{{ $buy->cart->product->price }}$</td>
                    <td>{{ $buy->cart->product->price * $buy->cart->quantity }}$</td>
                    <td>{{ $buy->payment ? 'Paid' : 'Unpaid' }}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    
@endsection

@section('title')
    Otomow Cart 
@endsection