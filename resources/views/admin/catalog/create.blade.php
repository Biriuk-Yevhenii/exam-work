@extends('admin.layouts.main')

@section('content')
    <h1>Add product</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($catalog, ['url' => '/admin/catalogs', 'files'=>true]) !!}
        @include('admin.catalog._form')
    {!! Form::close() !!}
@endsection

@section('title')
    Otomow Add Product
@endsection