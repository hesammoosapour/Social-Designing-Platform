<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}}</title>

    <!-- Fonts -->
    <script src="https://use.fontawesome.com/8bb16fde9e.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{asset('fontawesome-free-5.15.1-web/css/all.css')}}" rel="stylesheet"> <!--load all styles -->
    {{--    <link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    <style>
        .px-12{
            padding-right: 3rem;
            padding-left: 3rem;
        }
    </style>
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
    @yield('styles')
</head>
<body class="antialiased">

<div class="sticky-top flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    {{--    min-h-screen --}}
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/panel') }}" class="text-sm text-gray-700 dark:text-gray-500 " style="font-size: 1.25rem">پنل</a>
                {{--                underline--}}
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500  "
                   {{--                   underline--}}
                   style="font-size: 1.25rem">ورود</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class=" text-sm text-gray-700 dark:text-gray-500
{{--                    ml-4--}}
                        " style="font-size: 1.25rem;margin-right: 2rem">ثبت نام</a>
                    {{--                    underline--}}

                @endif
            @endauth
        </div>
    @endif
    <h5 class="text-center sticky-top" ><a href="{{route('.')}}">
            پلتفرم اشتراک گذاری تصاویر طراحی</a></h5>

</div>
<br>
@section('home-search')
    {!! Form::open(['method'=>'GET','action'=>'HomeController@search',
    'class'=>'form-inline offset-1 offset-sm-2 offset-md-3 col-10 col-sm-6 row' ]) !!}
    <div class="form-group col-2">
        <button class="btn btn-outline-primary btn-info text-light  " type="submit"
                style="height: 39px;"><i class="fa fa-search">  جستجو </i>
        </button>
    </div>
    <div class="form-group col-10"  >
        {!! Form::text('search',null,['class'=>'form-control','placeholder'=>"جستجوی برچسب ها،طراحان" ,'type'=>"search",
        'style'=>'direction:rtl']) !!}
    </div>
    {!! Form::close() !!}
@stop
@yield('home-search')


@section('home-content')
<div class="container mt-5 mb-3 " style="direction: rtl">

    <div class="row justify-content-start">
        @foreach($designers as $designer)
            @foreach($designer->getMedia('Design') as $designer_photo)
                @php
                    $privacy = DB::table('media')->where('uuid',$designer_photo->uuid)->first('privacy')->privacy ;
                @endphp
                @if($privacy == 'public')
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card p-3 mb-2">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="icon"> <i class="bx bxl-mailchimp"></i> </div>
                                    <div class="ms-2 c-details">
                                        <h6 class="mb-0">{{$designer->name}}</h6>
                                        <span>{{$designer_photo->created_at}}</span>
                                    </div>
                                </div>
                                <div class="badge"> <span>طراحی</span> </div>
                            </div>
                            <div class="mt-5">
                                <h3 class="heading text-center">
                                    <img src="{{$designer_photo->getUrl('card')}}" style="height: 250px;width: 250px"
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
                                                     $photos_tags = \App\Models\MediaTag::whereMedia_id($designer_photo->id)->get();
                                                     foreach ($photos_tags as $key => $photo_tag) {
                                                         echo $photo_tag->tag->name;
                                                         if($key < count($photos_tags)-1)
                                                             echo '،';
                                                     }
                                                 @endphp
                                            </span>
                                        </span>
                                        <div class="col-10">
                                            <a href="{{$designer_photo->getUrl()}}">
                                                <i class="text-info fas fa-eye fa-2x" title="مشاهده عکس"></i></a>
                                        </div>
                                        <div class="col-2">
{{--                                            todo : redundant here ,all pics here are private--}}
                                            <i class=" <?= $designer_photo->privacy == 'private' || $designer_photo->privacy == 'privateOnly'
                                                ? 'fab fa-accessible-icon' : 'fa fa-universal-access' ?>
                                                fa-2x"    aria-hidden="true"
                                               title="<?= $designer_photo->privacy == 'private' || $designer_photo->privacy == 'privateOnly'
                                                   ? 'دسترسی خصوصی' : 'دسترسی عمومی' ?>"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            @endforeach
        @endforeach

    </div>
</div>
@endsection
@yield('home-content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script type="text/javascript" scr="{{asset('js/popper.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script type="text/javascript" scr="{{asset('js/bootstrap.min.js')}}"></script>


</body>
</html>
