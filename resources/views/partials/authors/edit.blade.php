<div class="form-group">
    {!! Form::label('first_name', 'First Name:', ['class' => 'control-label']) !!}
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('last_name', 'Last Name:', ['class' => 'control-label']) !!}
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('user_file', 'Upload a photo:', ['class' => 'control-label']) !!}
    @if (isset($author))
        @if ($author->photo)
            <br />
            {!! Html::image('/' . Config::get('constants.image_path') . '/' . $author->photo, $author->first_name . ' ' . $author->last_name, array('class' => 'img-thumbnail', 'style' => 'width:160px;height:auto')) !!}
        @endif
    @endif
    {!! Form::file('user_file', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('homepage_url', 'Homepage URL:', ['class' => 'control-label']) !!}
    {!! Form::text('homepage_url', null, ['class' => 'form-control']) !!}
</div>
