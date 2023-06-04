@extends('admin.layouts.main')

@section('content')
    <div class="position-relative" style="min-height: 80vh">
        <h1>{{$email->name}}</h1>
        <div>id - {{$email->id}}</div>
        <hr>
        <div class="p-3">
            <div class="">
                <div class="message-chat px-3 py-2 mb-3" style="width: 70%;background-color: rgba(0, 255, 255, 0.568);">
                    <div class="d-flex justify-content-between">
                        <p style="word-wrap: break-word; overflow-wrap: break-word; width: 85%;">{{$email->name}} {{$email->email}}</p>
                        <small>{{$email->created_at->format('d.m.Y H:i')}}</small>
                    </div>
                    <p style="word-wrap: break-word; overflow-wrap: break-word; width: 85%;">{{$email->message}}</p>
                </div>          

                @foreach ($messages as $item)
                    <div class="message-chat px-3 py-3 d-flex justify-content-between mb-3" style="width: 70%; @if($item->role == 'admin')float: right; background-color: rgba(128, 128, 128, 0.486); @else background-color: rgba(0, 255, 255, 0.568); @endif ">
                        @if($item->created_at)<small>{{$item->created_at->format('d.m.Y H:i')}}</small> @endif
                        <p style="width: 85%; word-wrap: break-word; word-break: break-all;">{{$item->message}}</p>
                    </div>      
                @endforeach
            </div>
        </div>
        
        <form action="/admin/email/chat" method="post" style="position: absolute; width: 100%; bottom: 0">
            @csrf
            <input type="hidden" name="email_id" value="{{$email->id}}">
            <input type="hidden" name="name" value="Admin">
            <input type="hidden" name="role" value="admin">
            <input type="hidden" name="em" value="support@admin.com">
            <input type="hidden" name="email_to" value="{{$email->email}}">
            <input type="hidden" name="id" value="{{$email->id}}">

            <div class="row justify-content-between">
                <div class="form-floating" style="width: 95%">
                    <textarea name="message" class="form-control" placeholder="Message" id="floatingTextarea2" style="height: 100px; max-height: 200px;" rows="20" id="myTextarea"></textarea>
                </div>
                <button class="btn btn-primary">Send</button>
            </div>
        </form>

        {{-- <input class="form-control" style="width: 95%" type="text" placeholder="Message" aria-label="default input example"> --}}
        {{--< form action="/send-mail" method="post">
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
            <div class="button">
                <input type="button" value="Send">
            </div>
        </> --}}

    </div>
@endsection

@section('title')
Otomow Chat
@endsection