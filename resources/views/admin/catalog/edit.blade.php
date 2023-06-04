@extends('admin.layouts.main')

@section('content')
    <h1>Edit product</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($catalog, ['url' => '/admin/catalogs/'. $catalog->id, 'files'=>true, 'method'=>'put']) !!}
        @include('admin.catalog._form')
    {!! Form::close() !!}
@endsection

@section('title')
    Otomow Add Product
@endsection