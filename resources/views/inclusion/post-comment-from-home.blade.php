{!! Form::open(['method'=>'POST', 'action'=> 'CommentsController@store']) !!}

<input type="hidden" name="post_id" value="{{$post_media[0]->post_id}}">

<div class="row">
    <div class="form-group col-10">
        {!! Form::textarea('body', null, ['class'=>'form-control border-0',
        'rows'=>2, 'placeholder'=>'یادداشت بگذارید...','style'=>'resize:none;'])!!}
    </div>
    <div class="form-group col-2">
        {!! Form::submit('ارسال', ['class'=>'btn link-primary']) !!}
    </div>
</div>
{!! Form::close() !!}
