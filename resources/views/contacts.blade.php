@extends('layouts.app')

@section('content')
    {{-- <h1>Contacts</h1>
    <form action="/send-mail" method="post">
        @csrf
        <div class="form-group">
            <label for="">Name:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Email:</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Message:</label>
            <textarea class="form-control @error('message') is-invalid @enderror" name="message" value="{{ old('message') }}"></textarea>
            @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button class="btn btn-light mt-3">Send</button>
    </form> --}}

    <div class="contact-body my-4" >
        <div class="content">
            <div class="left-side">
                <div class="address details">
                    <i class="fa-solid fa-location-dot"></i>
                    <div class="topic">Adress</div>
                    <div class="text-one">Poland, Czestochowa</div>
                    <div class="text-two">Adama Bienia, 16</div>
                </div>
                <div class="phone details">
                    <i class="fa-solid fa-phone"></i>
                    <div class="topic">Phone</div>
                    <div class="text-one">+48 536-286-013</div>
                    <div class="text-two">+38 096-404-21-16</div>
                </div>
                <div class="email details">
                    <i class="fa-solid fa-envelope"></i>
                    <div class="topic">Adress</div>
                    <div class="text-one">support@site.com</div>
                    <div class="text-two">admin@site.com</div>
                </div>
            </div>
            <div class="right-side">
                <div class="topic-text">Send a message to us.</div>
                <p>If you have a questions or proposalls for cooperation - fill out the form below.</p>
                <form action="/send-mail" method="post">
                    @csrf
                    <div class="input-box">
                        <input type="text" class="@error('name') is-invalid @enderror" placeholder="Enter your name" name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder="Enter your email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-box message-box">
                        <textarea placeholder="Enter your message" class="@error('message') is-invalid @enderror" name="message" value="{{ old('message') }}"></textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="text" value="0" name="read" style="display: none">
                    <button class="button"><input type="button" value="Send"></button>
                    {{-- <div class="button">
                        <input type="button" value="Send">
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
    
@endsection

@section('title')
    Otomow Contacts
@endsection