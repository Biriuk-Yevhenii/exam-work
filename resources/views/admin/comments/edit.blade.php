@extends('admin.layouts.main')

@section('content')
    <h1>Edit Comment</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($comment, ['url' => '/admin/comments/'.$comment->id, 'method' => 'put']) !!}
    @include('admin.comments._form')
    {!! Form::close() !!}

@endsection

@section('title')
    Comment
@endsection