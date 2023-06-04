@extends('admin.layouts.main')

@section('content')
    <h1>Comments</h1>

    <a href="/admin/comments/create" class="btn btn-primary">Add article</a>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Comment</th>
                <th>Category</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $comment)    
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$comment->name}}</td>
                <td>{!!$comment->short_comment !!}</td>
                <td>{{$comment->article_id}}</td>
                <td>
                    <a href="/admin/comments/{{$comment->id}}/edit" class="btn btn-primary">Edit article</a>
                    {!! Form::open(['url' => '/admin/comments/'.$comment->id, 'method'=>'DELETE']) !!}
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger mt-1']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('title')
Otomow Comments
@endsection