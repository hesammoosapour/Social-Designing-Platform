<div class="d-flex">
    <div class="icon"> <i class="bx bxl-mailchimp"></i> </div>
    <div class="ms-2 c-details row">
        <div class="">
            <h5 class="mb-0">
                @php
                    $designer = App\Models\User::find($post_media[0]->model_id);
                @endphp
                <a href="{{route('{username}',$designer->username)}}"
                   class="link-dark"> <strong>{{$designer->name}}</strong></a>
            </h5>
        </div>
        {{--    <span>{{$post_media[0]->created_at}}</span>--}}
        <div class="">{{$post_media[0]->created_at}}</div>
        {{--                                todo get from post table--}}
    </div>

</div>
