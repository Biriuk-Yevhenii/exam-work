<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group mt-3">
    {!! Form::label('catalog_id', 'catalog:') !!}
    {!! Form::select('catalog_id', $catalogs, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group mt-3">
    {!! Form::label('comment', 'comment:') !!}
    {!! Form::textarea('comment', null, ['class'=>'form-control']) !!}
</div>
{!! Form::submit('Save', ['class'=>'btn btn-primary mt-3']) !!}