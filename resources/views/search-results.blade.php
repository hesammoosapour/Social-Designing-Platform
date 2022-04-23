@extends('home')
@section('styles')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <style>
        /*body{margin-top:20px;*/
        /*    background:#eee;*/
        /*}*/
        .single_advisor_profile {
            position: relative;
            margin-bottom: 50px;
            -webkit-transition-duration: 500ms;
            transition-duration: 500ms;
            z-index: 1;
            border-radius: 15px;
            -webkit-box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
            box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
        }
        .single_advisor_profile .advisor_thumb {
            position: relative;
            z-index: 1;
            border-radius: 15px 15px 0 0;
            margin: 0 auto;
            padding: 30px 30px 0 30px;
            background-color: #3f43fd;
            overflow: hidden;
        }
        .single_advisor_profile .advisor_thumb::after {
            -webkit-transition-duration: 500ms;
            transition-duration: 500ms;
            position: absolute;
            width: 150%;
            height: 80px;
            bottom: -45px;
            left: -25%;
            content: "";
            background-color: #ffffff;
            -webkit-transform: rotate(-15deg);
            transform: rotate(-15deg);
        }
        @media only screen and (max-width: 575px) {
            .single_advisor_profile .advisor_thumb::after {
                height: 160px;
                bottom: -90px;
            }
        }
        .single_advisor_profile .advisor_thumb .social-info {
            position: absolute;
            z-index: 1;
            width: 100%;
            bottom: 0;
            right: 30px;
            text-align: right;
        }
        .single_advisor_profile .advisor_thumb .social-info a {
            font-size: 14px;
            color: #020710;
            padding: 0 5px;
        }
        .single_advisor_profile .advisor_thumb .social-info a:hover,
        .single_advisor_profile .advisor_thumb .social-info a:focus {
            color: #3f43fd;
        }
        .single_advisor_profile .advisor_thumb .social-info a:last-child {
            padding-right: 0;
        }
        .single_advisor_profile .single_advisor_details_info {
            position: relative;
            z-index: 1;
            padding: 30px;
            text-align: right;
            -webkit-transition-duration: 500ms;
            transition-duration: 500ms;
            border-radius: 0 0 15px 15px;
            background-color: #ffffff;
        }
        .single_advisor_profile .single_advisor_details_info::after {
            -webkit-transition-duration: 500ms;
            transition-duration: 500ms;
            position: absolute;
            z-index: 1;
            width: 50px;
            height: 3px;
            background-color: #3f43fd;
            content: "";
            top: 12px;
            right: 30px;
        }
        .single_advisor_profile .single_advisor_details_info h6 {
            margin-bottom: 0.25rem;
            -webkit-transition-duration: 500ms;
            transition-duration: 500ms;
        }
        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .single_advisor_profile .single_advisor_details_info h6 {
                font-size: 14px;
            }
        }
        .single_advisor_profile .single_advisor_details_info p {
            -webkit-transition-duration: 500ms;
            transition-duration: 500ms;
            margin-bottom: 0;
            font-size: 14px;
        }
        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .single_advisor_profile .single_advisor_details_info p {
                font-size: 12px;
            }
        }
        .single_advisor_profile:hover .advisor_thumb::after,
        .single_advisor_profile:focus .advisor_thumb::after {
            background-color: #070a57;
        }
        .single_advisor_profile:hover .advisor_thumb .social-info a,
        .single_advisor_profile:focus .advisor_thumb .social-info a {
            color: #ffffff;
        }
        .single_advisor_profile:hover .advisor_thumb .social-info a:hover,
        .single_advisor_profile:hover .advisor_thumb .social-info a:focus,
        .single_advisor_profile:focus .advisor_thumb .social-info a:hover,
        .single_advisor_profile:focus .advisor_thumb .social-info a:focus {
            color: #ffffff;
        }
        .single_advisor_profile:hover .single_advisor_details_info,
        .single_advisor_profile:focus .single_advisor_details_info {
            background-color: #070a57;
        }
        .single_advisor_profile:hover .single_advisor_details_info::after,
        .single_advisor_profile:focus .single_advisor_details_info::after {
            background-color: #ffffff;
        }
        .single_advisor_profile:hover .single_advisor_details_info h6,
        .single_advisor_profile:focus .single_advisor_details_info h6 {
            color: #ffffff;
        }
        .single_advisor_profile:hover .single_advisor_details_info p,
        .single_advisor_profile:focus .single_advisor_details_info p {
            color: #ffffff;
        }

    </style>
@stop
@section('home-search')
    {!! Form::open(['method'=>'GET','action'=>'HomeController@search',
  'class'=>'form-inline offset-1 offset-sm-2 offset-md-3 col-10 col-sm-6 row' ]) !!}
    <div class="form-group col-2">
        <button class="btn btn-outline-primary btn-info text-light  " type="submit"
                style="height: 39px;"><i class="fa fa-search">  جستجو </i>
        </button>
    </div>
    <div class="form-group col-10"  >
        {!! Form::text('search',null,['class'=>'form-control','placeholder'=>"$searched" ,'type'=>"search",
                'style'=>'direction:rtl','autofocus']) !!}
    </div>
    {!! Form::close() !!}
@stop
@section('home-content')
    @if (isset($tag_search))
        @foreach($tag_search as $items)
            @foreach($items->mediaTag as $item)
                @php
                    $medias_ids[] = $item->media_id;
                @endphp

            @endforeach
        @endforeach
        @if(isset($medias_ids))
            <h5 style="direction:rtl" class="mx-5">طراحی هایی با تگ : <?= $searched ?></h5>
            @php
                $medias_ids = array_unique($medias_ids);
            @endphp
            <?php  $medias = \App\Models\Media::whereIn('id',$medias_ids)
                ->whereModel_type('APP\Models\User')->get(); ?>
            <div class="container mt-5 mb-3 " style="direction: rtl">
                <div class="row justify-content-start">
                    @foreach($medias as $media_item)
                        @if($media_item->privacy == 'public')
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="card p-3 mb-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-row align-items-center">
                                            <div class="icon"> <i class="bx bxl-mailchimp"></i> </div>
                                            <div class="ms-2 c-details">
                                                <h6 class="mb-0">
                                                    {{\App\Models\User::find($media_item->model_id)->name}}</h6>
                                                <span>{{$media_item->created_at}}</span>
                                            </div>
                                        </div>
                                        <div class="badge"> <span>طراحی</span> </div>
                                    </div>
                                    <div class="mt-5">
                                        <h3 class="heading text-center">
                                            <img src="{{'storage/'.$media_item->order_column.'/'.$media_item->file_name}}"
                                                 class="img-fluid card_2_row" alt="" style="height: 250px;width: 250px">
                                        </h3>
                                        <div class="mt-5">
                                            {{--                        <div class="progress">--}}
                                            {{--                            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
                                            {{--                        </div>--}}
                                            <div class="row mt-3 ">
                                                <span class="text1 text-end">برچسب ها :
                                                    <span class="text2">
                                                        @php
                                                            $photos_tags = \App\Models\MediaTag::whereMedia_id($media_item->id)->get();
                                                            foreach ($photos_tags as $key => $photo_tag) {
                                                                echo $photo_tag->tag->name;
                                                                if($key < count($photos_tags)-1)
                                                                    echo '،';
                                                            }
                                                        @endphp
                                                    </span>
                                                </span>
                                                <div class="col-10">
                                                    <a href="{{'storage/'.$media_item->order_column.'/'.$media_item->file_name}}">
                                                        <i class="text-info fas fa-eye fa-2x" title="مشاهده پست"></i></a>
                                                </div>
                                                <div class="col-2">
                                                    <i class=" <?= $media_item->privacy == 'private' || $media_item->privacy == 'privateOnly'
                                                        ? 'fab fa-accessible-icon' : 'fa fa-universal-access' ?>
                                                        fa-2x"    aria-hidden="true"
                                                       title="<?= $media_item->privacy == 'private'  || $media_item->privacy == 'privateOnly'
                                                           ? 'دسترسی خصوصی' : 'دسترسی عمومی' ?>"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @else
            <br>
            <h5 class="alert alert-secondary text-center">!طراحی با این تگ پیدا نشد</h5>
        @endif
    @endif
    <hr>

    @if(isset($designer_search[0]))
        <div class="container" style="direction: rtl" >
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-lg-6">
                    <!-- Section Heading-->
                    <div class="section_heading text-center wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <h3>طراحان
                            {{--                                <span>ما</span>--}}
                        </h3>
                        {{--                            <p>Appland is completely creative, lightweight, clean &amp; super responsive app landing page.</p>--}}
                        <div class="line"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($designer_search as $key => $item)
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single_advisor_profile wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                            <!-- Team Thumb-->
                            <div class="advisor_thumb">
                                <a href="{{route('{designer_id}.photos',$item->id)}}">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="">
                                </a>
                                <!-- Social Info-->
                                <div class="social-info"><a href="#">
                                        <i class="fa fa-facebook"></i></a><a href="#">
                                        <i class="fa fa-twitter"></i></a><a href="#">
                                        <i class="fa fa-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="single_advisor_details_info">
                                <a href="{{route('{designer_id}.photos',$item->id)}}">
                                    <h6>{{$item->name}}</h6>
                                    <p class="designation">طراح</p>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <br>
        <h5 class="alert alert-secondary text-center">!کاربری به این اسم پیدا نشد</h5>
    @endif

@stop
