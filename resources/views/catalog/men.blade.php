@extends('catalog.index')

@section('catalog_content')
    <div class="container">
        <div class="row justify-content-around">
            @foreach ($catalogs as $item)
            <div class="col-xl-3 col-lg-4 col-md-5 col-sm-5 py-3" >
                <a class="catalog-links" href="/catalog/readMore/{{$item->id}}" style="m-3">
                    <img src="{{$item->image}}" alt="{{$item->name}}">
                    <p style="margin-bottom: 5px">{{$item->short_title}}</p>
                    <p style="margin-bottom: 5px">{{$item->price}} $</p>
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
    </div>
@endsection