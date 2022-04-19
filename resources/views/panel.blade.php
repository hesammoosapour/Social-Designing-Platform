<x-app-layout>
    @section('styles')
        <style>
            .card_2_row {
                height: 300px;
                width: 500px ;
            }
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
        <style>
            body {
                background-color: #eee
            }

            .card {
                border: none;
                border-radius: 10px
            }

            .c-details span {
                font-weight: 300;
                font-size: 13px
            }

            .icon {
                width: 50px;
                height: 50px;
                background-color: #eee;
                border-radius: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 39px
            }

            .badge span {
                background-color: #fffbec;
                width: 60px;
                height: 25px;
                padding-bottom: 3px;
                border-radius: 5px;
                display: flex;
                color: #fed85d;
                justify-content: center;
                align-items: center
            }

            .progress {
                height: 10px;
                border-radius: 10px
            }

            .progress div {
                background-color: red
            }

            .text1 {
                font-size: 14px;
                font-weight: 600
            }

            .text2 {
                color: #a5aec0
            }
        </style>
    @stop
    <x-slot name="header">
        <div class="row">
            <a class="btn btn-primary col-2" href="{{route('customers')}}">مشتریان</a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight col-10" style="direction: rtl">
                {{ __('پنل').' '.($user->name) }}
            </h2>
        </div>
    </x-slot>

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
                    @endrole

                    @role('Designer')
                    <div class="container-fluid ">
                        <h3>   طراحی های {{$user->name}}  : </h3>
                    </div>
                    <p > لینک عکس های پروفایل شما:
                        <a href="{{route('{designer_id}.photos',$user->id)}}" class="btn btn-link">
                            {{route('{designer_id}.photos',$user->id)}}
                        </a>
                    </p>
                    <div class="container mt-5 mb-3 ">
                        <div class="row justify-content-start">
                            @foreach($design_photos as $key => $design_photo)
                                @php
                                    $privacy = DB::table('media')->where('uuid',$design_photo->uuid)->first('privacy')->privacy ;
                                @endphp
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <div class="card p-3 mb-2">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex flex-row align-items-center">
                                                <div class="icon"> <i class="bx bxl-mailchimp"></i> </div>
                                                <div class="ms-2 c-details">
                                                    <h6 class="mb-0">{{$user->name}}</h6>
                                                    <span>{{$design_photo->created_at}}</span>
                                                </div>
                                            </div>
                                            <div class="badge"> <span>طراحی</span> </div>
                                        </div>
                                        <div class="mt-5">
                                            <h3 class="heading text-center">
                                                <img src="{{$design_photo->getUrl('card')}}" style="height: 250px;width: 250px"
                                                     class="img-fluid card_2_row" alt="" >
                                            </h3>
                                            <div class="mt-5">
                                                {{--                        <div class="progress">--}}
                                                {{--                            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
                                                {{--                        </div>--}}
                                                <div class="row mt-3 ">
                                                    <span class="text1 text-end">برچسب ها :
                                                        <span class="text2">
                                                            @php
                                                                $photos_tags = \App\Models\MediaTag::whereMedia_id($design_photo->id)->get();
                                                                foreach ($photos_tags as $key => $photo_tag) {
                                                                    echo $photo_tag->tag->name;
                                                                    if($key < count($photos_tags)-1)
                                                                        echo '،';
                                                                }
                                                            @endphp
                                                        </span>
                                                    </span>
                                                    <div class="col-10">
                                                        <a href="{{$design_photo->getUrl()}}">
                                                            <i class="text-info fas fa-eye fa-2x" title="مشاهده عکس"></i></a>
                                                    </div>
                                                    <div class="col-2">
                                                        <a href="{{route('{uuid}.change-privacy',$design_photo->uuid)}}">
                                                            <i class=" <?= $design_photo->privacy == 'private' || $design_photo->privacy == 'privateOnly'
                                                                ? 'fab fa-accessible-icon' : 'fa fa-universal-access' ?>
                                                                fa-2x"    aria-hidden="true"
                                                               title="<?= $design_photo->privacy == 'private' || $design_photo->privacy == 'privateOnly'
                                                                   ? 'دسترسی خصوصی' : 'دسترسی عمومی' ?>"
                                                            <?= $design_photo->privacy == 'privateOnly' ? 'style="color: red"' : ''  ?> >
                                                            </i>
                                                        </a>
                                                    </div>
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
    @stop
</x-app-layout>
