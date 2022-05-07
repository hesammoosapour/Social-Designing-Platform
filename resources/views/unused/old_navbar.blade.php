<div class="sticky-top flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    {{--        min-h-screen--}}
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/panel') }}" class="text-sm text-gray-700 dark:text-gray-500 " style="font-size: 1.25rem">پنل</a>
                {{--                                underline--}}
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500  "
                   {{--                       underline--}}
                   style="font-size: 1.25rem">ورود</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class=" text-sm text-gray-700 dark:text-gray-500
                    ml-4
                        " style="font-size: 1.25rem;margin-right: 2rem">ثبت نام</a>
                    {{--                                        underline--}}
                @endif
            @endauth
        </div>
    @endif
    <h5 class="text-center sticky-top" ><a href="{{route('.')}}">
            پلتفرم اشتراک گذاری تصاویر طراحی</a></h5>

</div>
{{--<br>--}}
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
