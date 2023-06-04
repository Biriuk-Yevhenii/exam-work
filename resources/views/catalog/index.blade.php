@extends('layouts.app')

@section('content')
    <h1 class="small-catalog-catalog-h1">Catalog</h1>

    <div class="row">
        <!-- Sidebar with categories -->
        <div class="col-md-3 mediad-disable-category">
            <div class="list-group" style="background: #1A1A1A">
                @foreach ($categories_sidebar as $item)
                    <a style="background: #272727;" href="/cat/{{$item->slug}}" class=" list-group-item list-group-item-action d-flex justify-content-between align-items-center c-links-category">
                        {{$item->name}}
                        <span class="badge badge-secondary badge-pill">{{$item->catalogs_count}}</span>
                    </a>
                @endforeach
            </div>
            {!! Form::open(['url' => '/cat/filters']) !!}

                <div class="list-group mt-3" style="background: #272727; padding: 5px">{{-- Gender --}}
                    
                    Gender
                    <div class="form-check">
                        {{ Form::radio('gender', 'men', request('gender') == 'men', ['id' => 'men', 'class' => 'form-check-input']) }}
                        {{ Form::label('men', 'Dress for mens', ['class' => 'form-check-label']) }}
                    </div>
                    <div class="form-check">
                        {{ Form::radio('gender', 'girl', request('gender') == 'girl', ['id' => 'girl', 'class' => 'form-check-input']) }}
                        {{ Form::label('girl', 'Dress for woomens', ['class' => 'form-check-label']) }}
                    </div>
                </div>
            
                <div class="list-group mt-3" style="background: #272727; padding: 5px"> {{-- Size --}}
                    <div class="row scrollbar" style="height: 200px; overflow: auto;">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="size-" name="size[]" value="-">
                                <label class="form-check-label" for="size-">-</label>
                            </div>
                            @for ($i = 20; $i <= 54; $i++)
                                <div class="form-check">
                                    {{ Form::checkbox('size[]', $i, null, ['id' => 'size' . $i, 'class' => 'form-check-input']) }}
                                    {{ Form::label('size' . $i, $i, ['class' => 'form-check-label']) }}
                                </div>
                            @endfor
                        </div>
                        <div class="col">
                            @for ($i = 55; $i <= 90; $i++)
                                <div class="form-check">
                                    {{ Form::checkbox('size[]', $i, null, ['id' => 'size' . $i, 'class' => 'form-check-input']) }}
                                    {{ Form::label('size' . $i, $i, ['class' => 'form-check-label']) }}
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>                
                <div class="list-group mt-3" style="background: #272727; padding: 5px"> {{-- Price --}}
                    <div>
                        <input type="text" class="js-range-slider" name="my_range" value=""
                        data-type="double"
                        data-min="0"
                        data-max={{$max_price}}
                        data-from="0"
                        data-to= {{$max_price}}
                        data-grid="true"
                    />
                    <div class="d-flex justify-content-between"> 
                        <div class="form-group">
                            <label for="min-price">Min Price</label>
                            <input type="number" class="form-control" id="min-price" min="0" max="{{$max_price}}" value="0">
                        </div>
                        <div class="form-group">
                            <label for="max-price">Max Price</label>
                            <input type="number" class="form-control" id="max-price" min="0" max="{{$max_price}}" value="{{$max_price}}">
                        </div>        
                    </div>
                </div>                   
                </div>
                <div class="list-group mt-3" style="background: #272727; padding: 5px"> {{-- Season --}}
                    Season
                    <div class="col">
                        <div class="form-check">
                            {{ Form::checkbox('season[]', '1', in_array('1', request('season', [])), ['id' => '1', 'class' => 'form-check-input']) }}
                            {{ Form::label('1', 'Summer', ['class' => 'form-check-label']) }}
                        </div>
                        <div class="form-check">
                            {{ Form::checkbox('season[]', '2', in_array('2', request('season', [])), ['id' => '4', 'class' => 'form-check-input']) }}
                            {{ Form::label('2', 'Winter', ['class' => 'form-check-label']) }}
                        </div>
                        <div class="form-check">
                            {{ Form::checkbox('season[]', '3', in_array('3', request('season', [])), ['id' => '3', 'class' => 'form-check-input']) }}
                            {{ Form::label('3', 'All-season', ['class' => 'form-check-label']) }}
                        </div>
                        <div class="form-check">
                            {{ Form::checkbox('season[]', '4', in_array('4', request('season', [])), ['id' => '2', 'class' => 'form-check-input']) }}
                            {{ Form::label('4', 'Demi-season', ['class' => 'form-check-label']) }}
                        </div>
                        <div class="form-check">
                            {{ Form::checkbox('season[]', '5', in_array('5', request('season', [])), ['id' => '3', 'class' => 'form-check-input']) }}
                            {{ Form::label('5', 'Demi-season / Winter', ['class' => 'form-check-label']) }}
                        </div>
                        <div class="form-check">
                            {{ Form::checkbox('season[]', '6', in_array('6', request('season', [])), ['id' => '2', 'class' => 'form-check-input']) }}
                            {{ Form::label('6', 'Demi-season / Summer', ['class' => 'form-check-label']) }}
                        </div>
                    </div>
                </div>
                <div class="list-group mt-3" style="background: #272727; padding: 5px"> {{-- Country --}}
                    Country
                    <div class="col">
                        <div class="form-check">
                            {{ Form::checkbox('country[]', '1', in_array('1', request('country', [])), ['id' => '1', 'class' => 'form-check-input']) }}
                            {{ Form::label('1', 'Ukraine', ['class' => 'form-check-label']) }}
                        </div>
                        <div class="form-check">
                            {{ Form::checkbox('country[]', '4', in_array('4', request('country', [])), ['id' => '4', 'class' => 'form-check-input']) }}
                            {{ Form::label('4', 'Germany', ['class' => 'form-check-label']) }}
                        </div>
                        <div class="form-check">
                            {{ Form::checkbox('country[]', '3', in_array('3', request('country', [])), ['id' => '3', 'class' => 'form-check-input']) }}
                            {{ Form::label('3', 'USA', ['class' => 'form-check-label']) }}
                        </div>
                        <div class="form-check">
                            {{ Form::checkbox('country[]', '2', in_array('2', request('country', [])), ['id' => '2', 'class' => 'form-check-input']) }}
                            {{ Form::label('2', 'France', ['class' => 'form-check-label']) }}
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-around"> {{-- Apply Filters \ Reser Filters --}}
                    <div class="text-center mt-3"> 
                        {{ Form::submit('Apply Filters', ['class' => 'btn btn-light']) }}
                    </div>
                    <a class="btn btn-light text-center mt-3" href="/cat/reset/filters">Reset</a>
                </div>
                
            {!! Form::close() !!}
            


            
        </div>
        {{-- <div class="col-md-3 mediad-disable-category">
            <ul class="nav flex-column">
                @foreach ($categories_sidebar as $item)
                    <li class="nav-item">
                        <a href="/cat/{{$item->slug}}" class="nav-link catalog-links">
                            {{$item->name}}. Items: {{$item->catalogs_count}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div> --}}
        <div class="col-md-9">
            @yield('catalog_content')
        </div>
    </div>
@endsection

@section('title')
    Otomow Catalog 
@endsection