<div class="d-flex">
    <div class="icon"> <i class="bx bxl-mailchimp"></i> </div>
    <div class="ms-2 c-details row">
        <div class="">
            <h5 class="mb-0">
                <a href="{{route('{designer_id}.photos',$post_media[0]->model_id)}}"
                   class="link-dark"> <strong>{{\App\Models\User::find($post_media[0]->model_id)->name}}</strong></a>
            </h5>
        </div>
        {{--    <span>{{$post_media[0]->created_at}}</span>--}}
        <div class="">{{$post_media[0]->created_at}}</div>
        {{--                                todo get from post table--}}
    </div>

</div>
