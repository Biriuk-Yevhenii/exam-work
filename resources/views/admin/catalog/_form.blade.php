<div class="form-group">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('category_id', 'Category') !!}
    {!! Form::select('category_id', $category, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('country_id', 'Country') !!}
    {!! Form::select('country_id', $country, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('season_id', 'Season') !!}
    {!! Form::select('season_id', $season, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('gender', 'Gender', ['class' => 'control-label']) !!}
    <div class="form-check">
      {!! Form::radio('gender', 'men', null, ['class'=>'form-check-input', 'id'=>'men']) !!}
      {!! Form::label('men', 'Men', ['class' => 'form-check-label']) !!}
    </div>
    <div class="form-check">
      {!! Form::radio('gender', 'girl', null, ['class'=>'form-check-input', 'id'=>'girl']) !!}
      {!! Form::label('girl', 'Girl', ['class' => 'form-check-label']) !!}
    </div>
</div>

<div class="form-group">
    <div class="row" style="height: 200px; overflow-y: scroll;">
        <div class="col">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="size-" name="size[]" value="-" {{ in_array('-', $selectedSizes) ? 'checked' : '' }}>
                <label class="form-check-label" for="size-">-</label>
            </div>
            
            @for ($i = 20; $i <= 54; $i++)
                <div class="form-check">
                    {{ Form::checkbox('size[]', $i, in_array($i, $selectedSizes), ['id' => 'size' . $i, 'class' => 'form-check-input']) }}
                    {{ Form::label('size' . $i, $i, ['class' => 'form-check-label']) }}
                </div>
            @endfor
        </div>
        <div class="col">
            @for ($i = 55; $i <= 90; $i++)
                <div class="form-check">
                    {{ Form::checkbox('size[]', $i, in_array($i, $selectedSizes), ['id' => 'size' . $i, 'class' => 'form-check-input']) }}
                    {{ Form::label('size' . $i, $i, ['class' => 'form-check-label']) }}
                </div>
            @endfor
        </div>        
    </div>
</div>

<div class="form-group">
    {!! Form::label('price', 'Price') !!}
    {!! Form::text('price', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('content', 'Content') !!}
    {!! Form::textarea('content', null, ['class'=>'form-control']) !!}
</div>

{{-- <div class="form-group">
    {!! Form::label('image', 'Image') !!}
    {!! Form::file('image', ['class'=>'form-control']) !!}
</div> --}}

<div class="input-group mt-3">
    <span class="input-group-btn">
        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
        <i class="fa fa-picture-o"></i> Choose
        </a>
    </span>
    {!! Form::text('image', null, ['class'=>'form-control', 'id'=>"thumbnail"]) !!}
</div>
<div id="holder" style="margin-top:15px;">
    <img src="{{asset($catalog->image)}}" alt="" style="width: 100px">
</div>

<div class="mt-3 gallery-js">
    <h4>Gallery</h4>
    <div class="input-group mt-3">
        <span class="input-group-btn">
            <a id="lfm_gallery" data-input="thumbnail_gallery" data-preview="holder_gallery" class="btn btn-primary">
            <i class="fa fa-picture-o"></i> Choose
            </a>
        </span>
        {!! Form::text('gallery', null, ['class'=>'form-control', 'id'=>"thumbnail_gallery"]) !!}
    </div>
    <div id="holder_gallery" style="margin-top:15px;">
        @foreach ($catalog->gallery_images as $item)
            <div class="pos-relative d-inline-block">
                <div class="close" onclick="removeImage(this, '{{asset($item)}}')">x</div>
                <img src="{{asset($item)}}" alt="" style="width: 100px" >
            </div>
        @endforeach
        
    </div>
</div>

{!! Form::submit('Save', ['class'=>'btn btn-primary mt-3']) !!}