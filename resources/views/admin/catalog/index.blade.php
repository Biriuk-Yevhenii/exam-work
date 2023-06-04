@extends('admin.layouts.main')

@section('content')
    <h1>Catalog</h1>

    <a href="/admin/catalogs/create" class="btn btn-primary mb-3">Add product</a>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Content</th>
                <th>Price</th>
                <th>Category</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($catalogs as $catalog)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td><img style="width: 100px" src="{{asset($catalog->image)}}" alt="{{$catalog->title}}"></td>
                <td>{{$catalog->short_title}}</td>
                <td>{!!$catalog->short_content!!}</td>
                <td>{{$catalog->price}}$</td>
                <td>{{$catalog->category->name}}</td>
                <td>
                    <a href="/admin/catalogs/{{$catalog->id}}/edit" class="btn btn-primary">Edit</a>
                    {!! Form::open(['url'=>'/admin/catalogs/'. $catalog->id, 'method'=>'DELETE']) !!}
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger mt-2']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('title')
    Otomow Catalog
@endsection