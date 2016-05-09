<div class="form-group">
    {!! Form::label('forum_name', 'Sub-Category Name:', ['class' => 'control-label']) !!}
    {!! Form::text('forum_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('forum_desc', 'Short Description:', ['class' => 'control-label']) !!}
    {!! Form::text('forum_desc', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('forum_order', 'Order:', ['class' => 'control-label']) !!}
    {!! Form::text('forum_order', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('cat_id', 'Category:', ['class' => 'control-label']) !!}
    {!! Form::select('cat_id', $categories, null, ['class' => 'form-control', 'id' => 'license_id', 'placeholder' => 'Pick a license...']) !!}
</div>

