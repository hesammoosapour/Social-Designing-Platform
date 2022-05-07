<x-app-layout>
{{--    todo make a different page for admin panel--}}
    @section('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
    @stop
    <x-slot name="header">
        <div class="row ">
            <h4 class="font-semibold text-xl text-gray-800 leading-tight " style="direction: rtl">
                {{ __('پنل').' '.($user->name) }}
            </h4>
        </div>
    </x-slot>

    @role('Designer')
    <div class="rtl">
        <a href="{{route('{username}',$user->username)}}" class="btn btn-primary m-4">پروفایل من</a>
        <a class="btn btn-primary " href="{{route('customers')}}">مشتریان</a>
    </div>
    @endrole

    @if(session('private_only'))
        <div class=" text-center">
            <h5 class="alert alert-danger">{{session('private_only')}}</h5>
        </div>
    @endif

    <div class="py-12 " style="direction:rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @role('Admin')
                    <a href="{{route('create-post')}}" type="button" class="btn btn-primary">پست جدید</a>
                    <a href="{{route('admin.users')}}" type="button" class="btn btn-secondary">{{__('همه کاربران')}}</a>
                    @endrole

                    @role('Designer')
                    <div class="container-fluid ">
                        <h3>   طراحی های {{$user->name}}  : </h3>
                    </div>
                    <p > لینک پروفایل شما:
                        <a href="{{route('{username}',$user->username)}}" class="btn btn-link">
                            {{route('{username}',$user->username)}}
                        </a>
                    </p>
                    <div class="container mt-5 mb-3 ">
                        <div class="row justify-content-start">
{{--                            @foreach($designer_posts_medias as $key => $designer_post)--}}
{{--                                @php--}}
{{--                                    $privacy = DB::table('media')->where('uuid',$designer_post->uuid)->first('privacy')->privacy ;--}}
{{--                                @endphp--}}
{{--                                <div class="col-sm-12 col-md-6 col-lg-4">--}}
{{--                                    <div class="card p-3 mb-2">--}}
{{--                                        <div class="d-flex justify-content-between">--}}
{{--                                            <div class="d-flex flex-row align-items-center">--}}
{{--                                                <div class="icon"> <i class="bx bxl-mailchimp"></i> </div>--}}
{{--                                                <div class="ms-2 c-details">--}}
{{--                                                    <h6 class="mb-0">{{$user->name}}</h6>--}}
{{--                                                    <span>{{$designer_post->created_at}}</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="badge"> <span>طراحی</span> </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="mt-5">--}}
{{--                                            <h3 class="heading text-center">--}}
{{--                                                <img src="{{$designer_post->getUrl('card')}}" style="height: 250px;width: 250px"--}}
{{--                                                     class="img-fluid card_2_row" alt="" >--}}
{{--                                            </h3>--}}
{{--                                            <div class="mt-5">--}}
{{--                                                <div class="row mt-3 ">--}}
{{--                                                    <span class="text1 text-end">برچسب ها :--}}
{{--                                                        <span class="text2">--}}
{{--                                                            @php--}}
{{--                                                                $photos_tags = \App\Models\MediaTag::whereMedia_id($designer_post->id)->get();--}}
{{--                                                                foreach ($photos_tags as $key => $photo_tag) {--}}
{{--                                                                    echo $photo_tag->tag->name;--}}
{{--                                                                    if($key < count($photos_tags)-1)--}}
{{--                                                                        echo '،';--}}
{{--                                                                }--}}
{{--                                                            @endphp--}}
{{--                                                        </span>--}}
{{--                                                    </span>--}}
{{--                                                    <div class="col-10">--}}
{{--                                                        <a href="{{$designer_post->getUrl()}}">--}}
{{--                                                            <i class="text-info fas fa-eye fa-2x" title="مشاهده پست"></i></a>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-2">--}}
{{--                                                        <a href="{{route('{uuid}.change-privacy',$designer_post->uuid)}}">--}}
{{--                                                            <i class=" <?= $designer_post->privacy == 'private' || $designer_post->privacy == 'privateOnly'--}}
{{--                                                                ? 'fab fa-accessible-icon' : 'fa fa-universal-access' ?>--}}
{{--                                                                fa-2x"    aria-hidden="true"--}}
{{--                                                               title="<?= $designer_post->privacy == 'private' || $designer_post->privacy == 'privateOnly'--}}
{{--                                                                   ? 'دسترسی خصوصی' : 'دسترسی عمومی' ?>"--}}
{{--                                                            <?= $designer_post->privacy == 'privateOnly' ? 'style="color: red"' : ''  ?> >--}}
{{--                                                            </i>--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}

                                @foreach($designer_posts_medias as $key_post => $post_media)
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

                    @endrole
                </div>
            </div>
        </div>
    </div>


    @section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"  ></script>

        @include('inclusion.carousel.js')
        @include('inclusion.post-content.panel-js')
    @stop
</x-app-layout>
