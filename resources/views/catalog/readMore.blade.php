@extends('catalog.index')

@section('catalog_content')
    <div class="row">
        <div class="col-md-4">           
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                    @foreach ($catalog->gallery_images as $item)
                        <div class="carousel-item active">
                            <img src="{{$item}}" class="d-block w-100" alt=''>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            
        </div>

        <div class="col-md-8">
            <div class="col-md-8">
                <h3 class="mt-3 mt-md-0">{{$catalog->title}}</h3>
            </div>
            
            <h5 style="font-weight: 600">{{$catalog->price}} $</h5>

            {{-- buttons --}}
            <div class="row mt-3">
                <div class="col">
                    <a href="/cart/{{$catalog->id}}" class="btn btn-light add-to-card" data-id='{{$catalog->id}}'>
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                    <a href="/carts" class="btn btn-light ms-3 byu-it-now">
                        <b>Buy It Now</b>
                    </a>
                </div>
            </div>
            {{-- End buttons --}}
            
            
            <h5 class="mt-3">Description</h5>
            <h5 style="font-size: 17px" class="mt-3">{!! $catalog->content !!}</h5>

            {{-- Characters --}}
            <div class="table-responsive">
                <table class="table table-striped">
                    <tbody>
                        <tr style="color: #ffffff">
                            <th scope="row">Sizes</th>
                            <td >                                     
                                @if (isset($sizes[0]))
                                    @foreach ($sizes->toArray() as $key => $item)
                                        @if ($key !== array_key_last($sizes->toArray()))
                                            {{$item['size']}}, 
                                        @else
                                            {{$item['size']}}
                                        @endif
                                    @endforeach
                                @else
                                -
                                @endif

                            </td>
                        </tr>
                        <tr style="color: #ffffff">
                            <th scope="row">Country</th>
                            <td>{{$country_name}}</td>
                        </tr>
                        <tr style="color: #ffffff">
                            <th scope="row">Season</th>
                            <td>{{$season_name}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            {{-- End Characters --}}


        </div>
    </div>


    <h2 class="p-3 pt-5" style="text-align: center; font-size: 30px;color: #D4D4D4; font-weight: 600; font-family: Montserrat">You May Be Interested In</h2>
    <div class="row pb-5">  
        @foreach ($products as $item)
            <div class="col-xl-3 col-lg-4 col-md-5 col-sm-5 py-3" >
                <a class="catalog-links" href="/catalog/readMore/{{$item->id}}" style="m-3">
                    <img src="{{$item->image}}" alt="{{$item->name}}">
                    <p>{{$item->short_title}}</p>
                    <p>{{$item->price}} $</p>
                    <?php $avg = 0; $count = 0; ?>
                    @foreach ($comments as $com)
                        @if ($com->catalog_id === $item->id && $com->rating)
                            <?php $avg+=$com->rating; ++$count; ?>
                        @endif
                    @endforeach
                    <?php if($count > 0)$avg /= $count; ?>
                    <div class="rating-mini">
                        @for ($i = 0; $i < 5; $i++)
                            @if ($avg > $i)
                                <span class="active"></span>	
                            @else
                                <span></span>    
                            @endif
                        @endfor
                        
                    </div>
                    <span>({{$count}})</span>
                </a>
            </div>
        @endforeach
    </div>
    
    @foreach($comments as $com)
        <div class="comment">
            <img style="border: 1px solid gray" class="comment__img" src="{{$com->avatar}}" alt="Avatar">
            <div class="comment__content">
                <div class="comment__header">
                    <h5>{{$com->name}}</h5>
                    <span>{{$com->created_at->format('d.m.Y H:i')}}</span>
                </div>
                <p class="comment__text">{{$com->comment}}</p>
                <div class="comment__rating">
                    @for ($i = 0; $i < 5; $i++)
                        @if ($com->rating > $i)
                            <span class="active bi bi-star-fill"></span>	
                        @else
                            <span class="bi bi-star"></span>    
                        @endif
                    @endfor
                </div>
            </div>
        </div>
    @endforeach 
    

    {{$comments->links('pagination::bootstrap-5')}}

    
    
        
    <h2 class=" pt-5" style="font-size: 30px;color: #D4D4D4; font-weight: 600; font-family: Montserrat">Add Comment</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
        
        
    {!! Form::model($comments,['url' => '/comments']) !!}
        <div class="rating-area">
            <input type="radio" id="star-5" name="rating" value="5">
            <label for="star-5" title="Оценка «5»"></label>    
            <input type="radio" id="star-4" name="rating" value="4">
            <label for="star-4" title="Оценка «4»"></label>    
            <input type="radio" id="star-3" name="rating" value="3">
            <label for="star-3" title="Оценка «3»"></label>  
            <input type="radio" id="star-2" name="rating" value="2">
            <label for="star-2" title="Оценка «2»"></label>    
            <input type="radio" id="star-1" name="rating" value="1">
            <label for="star-1" title="Оценка «1»"></label>
        </div>
        @error('rating')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!} <span style="color:rgb(235, 52, 52); font-size: 20px">*</span>
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group mt-3" style="display: none">
            {!! Form::label('catalog_id', 'article:') !!}
            {!! Form::text('catalog_id', $catalog->id, ['class'=>'form-control ', 'readonly' => 'readonly']) !!}
        </div>
        
        <div class="form-group mt-3">
            {!! Form::label('comment', 'comment:') !!} <span style="color:rgb(235, 52, 52); font-size: 20px">*</span>
            {!! Form::textarea('comment', null, ['class'=>"form-control", 'style'=>'resize: none; height: 100px;']) !!}
            @error('comment')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        {!! Form::submit('Save', ['class'=>'btn btn-light mt-3']) !!}
    {!! Form::close() !!} 
  
@endsection

@section('title')
    Otomow Read More
@endsection