@php $user = auth()->user(); @endphp

<nav class="navbar navbar-expand-lg navbar-dark bg-dark  sticky-top" dir="rtl">
    <div class="container-fluid">
        <a class="navbar-brand " href="{{route('.')}}">{{config('app.name')}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse"  id="navbarSupportedContent" >
            <div class=" col-lg-7 " id="searchbar">
                <form class="d-flex">
                    {!! Form::open(['method'=>'GET','action'=>'HomeController@search',
                     'class'=>'form-inline offset-1 offset-sm-2 offset-md-3 col-10 col-sm-6 row' ]) !!}
                    <div class="form-group col-10"  >
                        {!! Form::text('search',null,['class'=>'form-control','placeholder'=>"جستجوی برچسب ها،طراحان" ,'type'=>"search",
                        'style'=>'direction:rtl']) !!}
                    </div>
                    <div class="form-group col-2">
                        <button class="btn btn-outline-primary btn-info text-light  " type="submit"
                                style="height: 39px;"><i class="fa fa-search">  جستجو </i>
                        </button>
                    </div>
                    {!! Form::close() !!}
                </form>
            </div>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0  col-lg-3">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false"> {{$user->name}}
                        </a>
                        <ul class="dropdown-menu text-center" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{route('{username}',$user->username)}}">
                                    <i class="fa fa-user "></i> پروفایل  </a></li>
                            <li><a class="dropdown-item" href="{{route('panel')}}">
                                    <i class="fa fa-tachometer "></i> پنل </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <div class="mt-3 space-y-1 ">
                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a  href="{{route('logout')}}" class="dropdown-item link-dark text-decoration-none"
                                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                            <i class="fa fa-sign-out "></i> {{ __('خروج') }}
                                        </a>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link  text-white " href="{{route('sign-in')}}">ورود / ثبت نام</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
