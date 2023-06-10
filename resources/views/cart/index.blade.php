@extends('layouts.app')

@section('content')
    {{-- 
    <table class="table" style="color: #ffffff">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carts as $catalog)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td><img style="width: 100px" src="{{$catalog->product->image}}" alt="{{$catalog->title}}"></td>
                <td>{{$catalog->product->short_title}}</td>
                <td>{{$catalog->product->price}}$</td>
                <td>
                    <input style="width: 30%" type="number" class="form-control input-quantity" value="{{$catalog->quantity}}" data-product-id="{{$catalog->product->id}}">
                </td>                
                <td>{{$catalog->product->price*$catalog->quantity}} $</td>
                <td>
                    {!! Form::open(['url'=>'/carts/'. $catalog->id, 'method'=>'DELETE']) !!}
                    {!! Form::submit('Remove', ['class'=>'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <button id="buyButton" style="text-align: center" class="btn btn-light" data-toggle="modal" data-target="#checkoutModal">Buy</button>

    <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="checkoutModalLabel" style="color: black">Cart</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background: none;">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                    
                    
                </div>
                <div class="modal-body">
                    <form action="start-chekout" method="POST" style="color:black">
                        @foreach ($carts as $item)
                            <input type="hidden" name="prod{{$loop->iteration}}" value="{{$item->id}}">
                            <input type="hidden" name="iterations" value="{{$loop->iteration}}">
                        @endforeach
                        <input type="hidden" name="payment" value="0">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                        @foreach ($carts as $catalog)
                            <input type="hidden" name="catalog_id" value="{{$catalog->product->id}}">
                        @endforeach

                        <div class="row">
                            <div class="col-md-6">
                                @csrf
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <select name="country" class="form-control" id="country" required>
                                        @foreach ($countryList as $country)
                                            <option value="{{ $country }}">{{ $country }}</option>
                                        @endforeach
                                    </select>
                                </div>    
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sity">City</label>
                                            <input type="text" name="sity" class="form-control" id="sity" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="post_code">Postal code</label>
                                            <input type="text" name="post_code" class="form-control" id="postcode" required>
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input name="address" class="form-control" id="address" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" id="name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sec_name">Surname</label>
                                            <input type="text" name="sec_name" class="form-control" id="surname" required>
                                        </div>
                                    </div>   
                                </div>
                                <div class="form-group">
                                    <label for="tel">Phone</label>
                                    <input type="tel" name="tel" class="form-control" id="phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 style="margin-bottom: 0" id="totalSubtotal">Cart subtotal: {{ $totalPrice }} USD</h5>
                                <h5 style="margin:5px 0 5px 0">Shipping: Free Shipping</h5>
                                <h5 id="totalPrice" style="margin-bottom: 10px" name="totalPrice" value='{{ $totalPrice }}'>Total: {{ $totalPrice }} USD</h5>
                                <button type="submit" class="btn btn-outline-success">Buy It Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <h1 class="d-md-none">Cart</h1>

    <div class="table-responsive">
        <table class="table table-striped" style="color: #ffffff">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th class="text-nowrap">Quantity</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $catalog)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><img style="width: 100px" src="{{$catalog->product->image}}" alt="{{$catalog->title}}"></td>
                    <td>{{$catalog->product->short_title}}</td>
                    <td>{{$catalog->product->price}}$</td>
                    <td class="text-nowrap">
                        <input style="width: 100%" type="number" class="form-control input-quantity" value="{{$catalog->quantity}}" data-product-id="{{$catalog->product->id}}">
                    </td>                
                    <td>{{$catalog->product->price*$catalog->quantity}} $</td>
                    <td>
                        {!! Form::open(['url'=>'/carts/'. $catalog->id, 'method'=>'DELETE']) !!}
                        {!! Form::submit('Remove', ['class'=>'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <button id="buyButton" style="text-align: center" class="btn btn-light" data-toggle="modal" data-target="#checkoutModal" @if ($totalPrice <=0)
        disabled
    @endif>Buy</button>

    <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document" style="min-height: 100vh; display: flex; align-items: center;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="checkoutModalLabel" style="color: black">Cart</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background: none;">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="start-chekout" method="POST" style="color:black">
                        @foreach ($carts as $item)
                            <input type="hidden" name="prod{{$loop->iteration}}" value="{{$item->id}}">
                            <input type="hidden" name="iterations" value="{{$loop->iteration}}">
                        @endforeach
                        <input type="hidden" name="payment" value="0">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                        @foreach ($carts as $catalog)
                            <input type="hidden" name="catalog_id" value="{{$catalog->product->id}}">
                        @endforeach

                        <div class="row">
                            <div class="col-md-6">
                                @csrf
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <select name="country" class="form-control" id="country" required>
                                        @foreach ($countryList as $country)
                                            <option value="{{ $country }}">{{ $country }}</option>
                                        @endforeach
                                    </select>
                                </div>    
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sity">City</label>
                                            <input type="text" name="sity" class="form-control" id="sity" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="post_code">Postal code</label>
                                            <input type="text" name="post_code" class="form-control" id="postcode" required>
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input name="address" class="form-control" id="address" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" id="name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sec_name">Surname</label>
                                            <input type="text" name="sec_name" class="form-control" id="surname" required>
                                        </div>
                                    </div>   
                                </div>
                                <div class="form-group">
                                    <label for="tel">Phone</label>
                                    <input type="tel" name="tel" class="form-control" id="phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 style="margin-bottom: 0" id="totalSubtotal">Cart subtotal: {{ $totalPrice }} USD</h5>
                                <h5 style="margin:5px 0 5px 0">Shipping: Free Shipping</h5>
                                <h5 id="totalPrice" style="margin-bottom: 10px" name="totalPrice" value='{{ $totalPrice }}'>Total: {{ $totalPrice }} USD</h5>
                                <button type="submit" class="btn btn-outline-success">Buy It Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('title')
    Otomow Cart 
@endsection