@extends('admin.layouts.main')

@section('content')
    <h1>Emails</h1>
    @foreach($emails as $e)
        <article class="my-3 border p-3" style="border-radius: 5px; @if($e->read == 0) background-color: rgba(92, 184, 92, 0.5);
            @endif">
            <div class="row justify-content-between" >
                <div style="width: 80%">
                    <h3>{{$e->name}}</h3>
                    <p>{{$e->message}}</p>
                    <p>{{$e->email}}</p>
                </div>
                <div class="pr-2">
                    <a href="/admin/email/{{$e->id}}" class="btn btn-primary" value="{{$e->id}}">Answer</a>
                </div>
            </div>
            
            
        </article>
    @endforeach 
    {{$emails->links('pagination::bootstrap-5')}}
    
@endsection

@section('title')
Otomow Emails
@endsection