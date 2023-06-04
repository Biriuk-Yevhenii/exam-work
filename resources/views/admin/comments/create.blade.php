@extends('admin.layouts.main')

@section('content')
    <h1>Add Comment</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($comment,['url' => '/admin/comments']) !!}
    @include('admin.comments._form')
    {!! Form::close() !!}

@endsection

@section('title')
Comment
@endsection