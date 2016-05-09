<div class="form-group">
    {!! Form::label('topic_title', 'Title:', ['class' => 'control-label']) !!}
    {!! Form::text('topic_title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('topic_description', 'Short Description:', ['class' => 'control-label']) !!}
    {!! Form::text('topic_description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('authorIds', 'Author(s):', ['class' => 'control-label']) !!}
    {!! Form::select('author_list[]', $authors, null, ['class' => 'form-control', 'id' => 'authorIds', 'multiple']) !!}
</div>

<div class="form-group">
    {!! Form::label('forumIds', 'Sub-Categories:', ['class' => 'control-label']) !!}
    {!! Form::select('forum_list[]', $forums, null, ['class' => 'form-control', 'id' => 'forumIds', 'multiple']) !!}
</div>

<div class="form-group">
    {!! Form::label('topic_published_at', 'Date for scheduled publication:', ['class' => 'control-label']) !!}
    {!! Form::text('topic_published_at', null, ['class' => 'form-control', 'id' => 'topic_published_at']) !!}
</div>

<div class="form-group">
    {!! Form::label('license_id', 'License:', ['class' => 'control-label']) !!}
    {!! Form::select('license_id', $licenses, null, ['class' => 'form-control', 'id' => 'license_id', 'placeholder' => 'Pick a license...']) !!}
</div>

<div class="form-group">
    {!! Form::label('user_file', 'Upload a cover:', ['class' => 'control-label']) !!}
    @if (isset($topic))
        @if ($topic->topic_cover)
            <br />
            {!! Html::image('/' . Config::get('constants.image_path') . '/' . $topic->topic_cover, $topic->topic_title, array('class' => 'img-thumbnail', 'style' => 'width:160px;height:auto')) !!}
        @endif
    @endif
    {!! Form::file('user_file', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('topic_ISBN10', 'ISBN-10:', ['class' => 'control-label']) !!}
    {!! Form::text('topic_ISBN10', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('topic_ISBN13', 'ISBN-13:', ['class' => 'control-label']) !!}
    {!! Form::text('topic_ISBN13', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('publisher_id', 'Publisher:', ['class' => 'control-label']) !!}
    {!! Form::select('publisher_id', $publishers, null, ['class' => 'form-control', 'id' => 'publisher_id', 'placeholder' => 'Pick a publisher...']) !!}
</div>

<div class="form-group">
    {!! Form::label('topic_publication_date', 'Publication Date:', ['class' => 'control-label']) !!}
    {!! Form::text('topic_publication_date', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('topic_pages', 'Paperback:', ['class' => 'control-label']) !!}
    {!! Form::number('topic_pages', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('topic_post_text', 'Description:', ['class' => 'control-label']) !!}
    {!! Form::textarea('topic_post_text', null, ['class' => 'form-control', 'id' => 'topic_post_text', 'rows' => '10', 'cols' => '80', 'data-sample' => '1']) !!}
</div>

<div class="form-group">
    {!! Form::label('topic_download_url', 'Download URL:', ['class' => 'control-label']) !!}
    {!! Form::text('topic_download_url', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('topic_tla', 'Text Link Ad:', ['class' => 'control-label']) !!}
    {!! Form::text('topic_tla', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('topic_status', 'Status:', ['class' => 'control-label']) !!}
    {!! Form::select('topic_status', ['1' => 'Active', '2' => 'Inactive'], null, ['class' => 'form-control', 'id' => 'topic_status', 'placeholder' => 'Pick a status...']) !!}
</div>

