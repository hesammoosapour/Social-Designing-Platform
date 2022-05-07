<x-app-layout>
    <x-slot name="header">
{{--        @if(isset($user))--}}
{{--            <div class="row">--}}
{{--                <h2 class="font-semibold text-xl text-gray-800 leading-tight col-10" style="direction: rtl">--}}
{{--                    {{ __('پنل').' '.($user->name) }}--}}
{{--                </h2>--}}
{{--            </div>--}}
{{--        @endif--}}
    </x-slot>
    @section('styles')
        <link rel="stylesheet" href="{{asset('css/home.css')}}">
        {{--    <link rel="stylesheet" href="{{asset('css/carousel-styles.css')}}">--}}
    @stop

{{--    @include('unused.old_navbar')--}}

    @section('home-content')
        <div class="container mt-5 mb-3 " style="direction: rtl">

            <div class="row justify-content-start">
                @foreach($posts_medias as $key_post => $post_media)

                    <div class="card p-3 mb-2">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center">
                                @include('inclusion.home-post-user')

                            </div>
                            <div class="badge"> <span>طراحی</span> </div>
                        </div>
                        <div class="mt-5">
                            <div class="heading text-center">
                                <div class="pt-2 pb-1"  style="background-color: #f0f1ff">
                                    <div class="container text-center my-3">
                                        <div class="row mx-auto my-auto justify-content-center">
                                            <div id="recipeCarousel-{{$key_post}}" class="carousel slide" data-bs-interval="false" data-bs-ride="carousel">
                                                <div class="carousel-inner" role="listbox">
                                                    @foreach($post_media as $key_media => $media)

                                                        <div class="carousel-item @if($key_media == 0 ) active @endif ">
                                                            <div class=" px-2">
                                                                <div class="card" style="background-color: gray;">
                                                                    <div class="card-img">
                                                                        <img src="{{env('APP_URL').'/storage/'.$media->id.'/'.$media->file_name}}"
                                                                             class=" img-fluid" style="height:500px;">
                                                                    </div>
                                                                    <div  class="card-img-overlay"></div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{--                                                 {{$key_media}}   style="position:fixed"--}}
                                                    @endforeach
                                                </div>
                                                <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel-{{$key_post}}" role="button" data-bs-slide="prev">
                                                    <span class="bg-dark carousel-control-prev-icon" aria-hidden="true"></span>
                                                </a>
                                                <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel-{{$key_post}}" role="button" data-bs-slide="next">
                                                    <span class="bg-dark carousel-control-next-icon" aria-hidden="true"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5">
                                {{--                            <div class="progress">--}}
                                {{--                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
                                {{--                            </div>--}}
                                <div class="row mt-3 ">
                                <span class="text1 text-end">برچسب ها :
                                    <span class="text2">
                                         @php
                                             $post_media_ids = \App\Models\Media::wherePost_id($post_media[0]->post_id)->pluck('id');
                                             $photos_tags = \App\Models\MediaTag::whereIn('media_id',$post_media_ids)->get();

                                                 foreach ($photos_tags as $key => $photo_tag) {
                                                     //echo $photo_tag->tag;
                                                     echo $photo_tag->tag->name;
                                                     if($key < count($photos_tags)-1)
                                                         echo '،';
                                                 }
                                         @endphp
                                    </span>
                                </span>
                                    <div class="row ">
                                        <div class="col-6">
                                            <button  id="{{$post_media[0]->post_id}}" data-bs-toggle="modal"
                                                     data-bs-target="#post_{{$post_media[0]->post_id}}"
                                                     aria-disabled="true" class="bg-transparent push" >
                                                {{--                                            route('post.{id}',$post_media[0]->post_id)  --}}
                                                {{--                                                    --}}
                                                <i class="text-info fas fa-eye fa-2x" title="مشاهده پست"></i></button>
                                        </div>
                                        <div class="col-1 offset-1 text-center my-1">
                                            <i class="fa fa-universal-access fa-2x"
                                               aria-hidden="true" title="دسترسی عمومی"></i>
                                        </div>
                                        <div class="col-1 offset-1 text-center my-1">
                                            <button id="{{$post_media[0]->post_id}}"
                                                    data-bs-toggle="modal" data-bs-target="#post_{{$post_media[0]->post_id}}"
                                                    aria-disabled="true" class="bg-transparent push" >
                                                <i class="far fa-comment fa-2x" aria-hidden="true" title="یادداشت ها"></i>
                                            </button>
                                        </div>
                                        <div class="col-1 offset-1 text-center">
                                            <?php
                                            if (isset($user)) {
                                                $like_of_post = $post_media[0]->post->likes->where('user_id', $user->id)
                                                    ->where('model_type', 'App\Models\Post')->where('model_id', $post_media[0]->post_id)->first();

                                                if ($like_of_post) $like_of_post = true; else $like_of_post = false;
                                            }
                                            ?>
                                            {!! Form::open(['method'=>'POST','action'=>'DesignerController@likeThePost']) !!}
                                            <input type="hidden" name="post_id" value="{{$post_media[0]->post_id}}">
                                            <button  type="submit" class=" btn " value="">
                                                <i class="<?php if (isset($like_of_post) && $like_of_post == true) echo  'fa' ; else echo 'far'; ?>  fa-heart fa-2x" title="لایک"
                                                   aria-hidden="true" <?php if (isset($like_of_post) && $like_of_post == true)  echo 'style="color:red" '; ?>></i>
                                            </button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="caption">
                                <div class="d-flex">
                                    @if(isset($post_media[0]->post->caption))
                                        <h5><strong>{{\App\Models\User::find($post_media[0]->model_id)->name}}:</strong></h5>
                                        <p>{{$post_media[0]->post->caption}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="cherry-pick-comments">
                                <?php $comments =  $post_media[0]->post->comments ?>
                                @if(isset( $comments[0] ))
                                    <button id="{{$post_media[0]->post_id}}" data-bs-toggle="modal"
                                            data-bs-target="#post_{{$post_media[0]->post_id}}"
                                            aria-disabled="true" class="bg-transparent push" >
                                        <h5 class="text-black-50">
                                            نمایش همه  {{count($post_media[0]->post->comments)}} یادداشت ها :
                                        </h5>
                                    </button>
                                    @foreach($comments as $key_comment => $comment)
                                        <div class="d-flex">
                                            <h5><strong>{{$comment->user->name}}: </strong></h5>
                                            <p>{{$comment->body}}</p>
                                        </div>
                                        @php if($key_comment == 1) break; @endphp
                                    @endforeach
                                @endif

                            </div>
                            <hr>
                            <div class="post-comment">
                                @include('inclusion.post-comment-from-home')
                            </div>
                        </div>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade " id="post_{{$post_media[0]->post_id}}" tabindex="-1" aria-labelledby="post_{{$post_media[0]->post_id}}_Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered position-sticky ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="modal-title" id="post_{{$post_media[0]->post_id}}_Label">
                                        @include('inclusion.home-post-user')
                                    </div>
                                    <button type="button" class="btn-close position-relative cbmhp"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body"></div>
                                <div class="modal-footer">
                                    <div class="post-comment-inside-post">
{{--                                       @include('inclusion.post-comment-from-home')--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach


            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            let items = document.querySelectorAll('.carousel .carousel-item')

            items.forEach((el) => {
                const minPerSlide = 1
                let next = el.nextElementSibling
                for (var i=1; i<minPerSlide; i++) {
                    if (!next) {
                        // wrap carousel by using first child
                        next = items[0]
                    }
                    let cloneChild = next.cloneNode(true)
                    el.appendChild(cloneChild.children[0])
                    next = next.nextElementSibling
                }
            })

        </script>
        <script>

            $(document).ready(function() {

                $('.push').click (function () {
                    //
                    var post_id = $(this).attr("id");
                    window.history.pushState('post', 'Title', "<?= env('APP_URL').'/post/' ?>" + post_id );

                    //         // event.preventDefault();
                    //

                    $.ajax({
                        url: "<?= route('.') ?>" + "/get-post-content/" + post_id,
                        method: "GET",
                        dataType: "JSON",
                        data: {
                            'post_id': post_id
                        },
                        success: function (response) {
                            if (response.status == 'ok') {
                                let comments = response.comments;
                                $('div.modal-body').empty();
                                comments.forEach((comment) => {
                                    $('div.modal-body').append(
                                        '<div class="d-flex">'
                                        + '<div class="icon"> <i class="bx bxl-mailchimp"></i> </div>' +
                                        '<h5><strong>'+ comment.name +':</strong></h5>&nbsp'
                                        + comment.body + '<br>' +
                                        '</div>');

                                });

                            }
                        },
                    });

                });

                $('.btn-close').click(function () {
                    window.history.pushState('home', 'Title',"<?= route('.' ) ?>" );
                    $('div.modal-body').empty();
                });

                $('.modal').on('hidden.bs.modal', function () {
                    window.history.pushState('home', 'Title', "<?= route('.' ) ?>" );

                });
            });
        </script>
    @stop
</x-app-layout>


