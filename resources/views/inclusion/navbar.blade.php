{{--@section('styles')--}}
{{--    <style>--}}
{{--        @media (max-width: 500px) {--}}
{{--            /*.dropdown-menu{*/--}}
{{--            /*    max-height:200px !important;*/--}}
{{--            /*    overflow-y:auto !important;*/--}}
{{--            /*}*/--}}
{{--        }--}}
{{--    </style>--}}
{{--@stop--}}
<div class="sticky-top all-navbars">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm main_navbar " style="max-height: 60px;">
        <div class="container-fluid">
            {{--            @if(Auth::check())--}}
            {{--                <button class="openbtn btn btn-light  pull-left" onclick="openNav()">☰ </button>--}}
            {{--                --}}{{--when it should be hidden first time after collpase get shown--}}
            {{--            @endif--}}

            <div class="">
                <a class="navbar-brand text-white" href="{{ url('/') }}" >
                    <img src="/images/siam-in-thailand.png" class="rounded-circle" height="50" alt="{{config('app.name')}}">
                    {{ config('app.name')  }}

                    @if(Auth::check())
                        {{--                            @if( URL::current() ==  URL::to('/become-tour-guide'))--}}
                        {{--                                -> Traveller Panel->Become A Tour Guide--}}
                        {{--                            @endif--}}
                        {{--                            @if( URL::current() ==  URL::to('/tour-guide'))--}}
                        {{--                                -> Tour Guides->index--}}
                        {{--                            @endif--}}
                        {{--                            @if( URL::current() ==  URL::to('/register-an-agency'))--}}
                        {{--                                -> Register An Agency--}}
                        {{--                            @endif--}}
                    @endif
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse " id="navbarSupportedContent" style="background-color: #4527A0 !important">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav col-xl-9 col-lg-7 col-md-5" id="left-navbar">
                    {!! Form::open(['method'=>'GET','action'=>'HomeController@search','class'=>'form-inline
                    col-lg-7 col-md-6','id'=>'form-search-navbar' ]) !!}
                    <div class="form-group row" id="div-search-navbar" >
                        {!! Form::text('search',null,['class'=>'form-control col-4 col-sm-8 col-md-3 col-lg-5 col-xl-7',
                        'placeholder'=>"Search" ,'type'=>"search",'aria-label'=>"Search" ,'id'=>'input-search-navbar']) !!}
                        {{--                    </div>--}}
                        {{--                    <div class="form-group offset-sm-1 offset-md-11 offset-lg-4">--}}
                        <button class="btn btn-outline-dark text-dark bg-white fa fa-search col-1" type="submit"
                                style="height: 39px;"></button>
                    </div>
                    {!! Form::close() !!}
                    @if(Auth::check())
                        <?php $user = auth()->user(); ?>
                        <ul class="d-flex col-lg-6 col-xl-4 offset-xl-1" style="list-style-type: none;" >
                            @if($user->current_role_id == 4)
                                @include('includes.user-notifications-navbar')
                            @elseif($user->current_role_id == 5) {{--   5 is super agent   --}}
                                @include('includes.agency-notifications-navbar')
                            @elseif($user->current_role_id == 3 || $user->current_role_id == 6)
                                {{--   3 is tour guide . 6 is agent   --}}
                                @include('includes.guide-notifications-navbar')
                            @elseif($user->current_role_id == 1) {{-- 1 is admin--}}
                                @include('includes.admin-notifications-navbar')
                            @endif

                            <li class="nav-item dropdown shopping_cart ">
                                <?php $count_cart = \App\ShoppingCart::whereTraveller_id($user->id)->whereStatus('yes')
                                    ->count(); ?>
                                <a href="{{route('cart')}}" class="nav-link text-white" style="display:  block ruby">
                                    <i class="fa fa-shopping-cart fa-2x"> </i>
                                    {{--                                    {{__('Shopping Cart')}}--}}
                                    @if($count_cart )
                                        <span class="badge badge-pill
                                       @if($user->current_role_id == 4)
                                            badge-success
                                        @elseif($user->current_role_id == 5) {{--   5 is super agent   --}}
                                            badge-primary
                                        @elseif($user->current_role_id == 3 || $user->current_role_id == 6)
                                        {{--   3 is tour guide . 6 is agent   --}}
                                            badge-warning
                                        @endif "
                                              @if($user->current_role_id == 1) style="background-color: hotpink"
                                            {{-- 1 is admin--}} @endif >{{$count_cart}}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item dropdown " id="role_navbar">
                                <a class="nav-link dropdown-toggle text-white " href="#"
                                   id="switchRole" role="button" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false"><h5>
                                        @if($user->currentRole)
                                            @if($user->currentRole->name == 'Super_Agent')
                                                {{__('Agency')}}
                                            @else
                                                {{__( $user->currentRole->name)}}
                                            @endif
                                        @else
                                            {{''}}
                                        @endif
                                    </h5>
                                </a>
                                @if(isset($user->roles) && count($user->roles) > 1)
                                    <div class="dropdown-menu" aria-labelledby="switchRole">
                                        <?php $user_roles = $user->roles; ?>
                                        <h5 class="text-center">{{'Switch To '}}</h5>
                                        <div class="dropdown-divider"></div>
                                        @foreach($user_roles as $key => $user_role)
                                            @if($user_role->id != $user->currentRole->id)
                                                <h5 class="text-center ">
                                                    <a  href="{{route('switch-user-role.{role_id}',$user_role->id)}}"
                                                        class="" >
                                                        {{--                                                    --}}
                                                        @if($user_role->name == 'Super_Agent')
                                                            {{__('Agency Account')}}
                                                        @else
                                                            {{__( $user_role->name . ' Account')}}
                                                        @endif
                                                    </a>
                                                </h5>
                                                @if($key+1   < count($user_roles))
                                                    <div class="dropdown-divider"></div>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </li>

                        </ul>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav col-xl-2 col-lg-4 mr-5">
                    <!-- Authentication Links -->

                    @guest
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else

                        <li class="nav-item dropdown ">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <?php $avatar_url = $user->getFirstMediaUrl('avatar','thumb');  ?>
                                <img src="@include('includes.avatar-user')" alt="avatar"
                                     class="rounded-circle" height="50" width="50">
                                {{ $user->first_name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown">
                                @if($user->current_role_id == 3 || $user->current_role_id == 6)
                                    <a  class="dropdown-item d-flex fa-2x" href="{{route('guide.{id}',$user->id)}}">
                                        <i class="fa fa-user-o" style="color: orange"></i> <h5> &nbsp; Guide Public Profile</h5>
                                    </a>
                                    <a  class="dropdown-item d-flex fa-2x" href="{{route('tour-guide.edit-profile')}}">
                                        <i class="fa fa-user-o" style="color: orange"></i> <h5> &nbsp; Edit Guide Profile</h5>
                                    </a>
                                @endif
                                @if($user->current_role_id == 4)
                                    <a  class="dropdown-item d-flex fa-2x" href="{{route('profile')}}">
                                        <i class="fa fa-user-circle-o" style="color: green"></i> <h5> &nbsp; Edit Profile</h5>
                                    </a>
                                    <a  class="dropdown-item d-flex fa-2x" href="{{route('user.{id}',$user->id)}}">
                                        <i class="fa fa-user-circle-o" style="color: green"></i>  <h5>&nbsp;  Traveller Profile</h5>
                                    </a>

                                @endif

                                @if($user->hasPermissionTo('agency.panel') && $user->current_role_id == 5)
                                    @php
                                        $user_agencies = \App\Agency::whereUser_id($user->id)->get();
                                    @endphp
                                    @foreach($user_agencies as $agency)
                                        <a  class="dropdown-item d-flex fa-2x"
                                            href="{{route('agency.{agency_id}',$agency->company_id)}}">
                                            <i class="fa fa-building" style="color: blue"></i> <h5> &nbsp; {{$agency->name}}
                                                Agency Profile</h5>
                                        </a>
                                    @endforeach
                                    <hr>
                                    <a  class="dropdown-item d-flex fa-2x" href="/agency-panel">
                                        <i class="fa fa-dashboard " style="color: blue"></i> <h5> &nbsp; Agency Panel</h5>
                                    </a>
                                @endif
                                @if($user->hasPermissionTo('tour_guide.panel') &&
                                ($user->current_role_id == 3 || $user->current_role_id == 6 ) )
                                    <hr>
                                    <a  class="dropdown-item d-flex fa-2x" href="{{route('tour-guide.panel')}}">
                                        <i class="fa fa-dashboard" style="color: orange"></i> <h5> &nbsp; Tour Guide Panel</h5>
                                    </a>
                                @endif
                                @if($user->hasPermissionTo('traveller.panel') && $user->current_role_id == 4)
                                    @if(!$user->hasRole('Tour_Guide') && !$user->hasRole('Super_Agent'))<hr>@endif
                                    <a  class="dropdown-item d-flex fa-2x" href="{{route('panel')}}">
                                        <i class="fa fa-dashboard" style="color: green"></i> <h5> &nbsp; Traveller Panel</h5>
                                    </a>
                                @endif
                                @if($user->hasRole('Admin') && $user->current_role_id == 1)
                                    <a  class="dropdown-item d-flex fa-2x" href="{{route('admin.panel')}}">
                                        <i class="fa fa-dashboard" style="color: deeppink"></i><h5>&nbsp; Admin Panel</h5>
                                    </a>
                                @endif
                                <hr>
                                <?php $unseen = DB::table('ch_messages')->whereTo_id($user->id)->whereSeen(0)->count(); ?>
                                <a  class="dropdown-item d-flex fa-2x" href="{{route('messages')}}">
                                    <i class="fas fa-comment-dots" style="color: blue"></i>

                                    <h5> &nbsp; {{__('Messenger')}}
                                        @if($unseen)
                                            <span class="menu-collapsed"><span class="badge badge-pill badge-primary ml-2">{{$unseen}}</span></span>
                                        @endif
                                    </h5>
                                </a>
                                <?php $count_wishlist = \App\Wishlist::whereUser_id($user->id)->whereStatus('yes')->count(); ?>
                                <a  class="dropdown-item d-flex fa-2x" href="{{route('wishlist')}}">
                                    <i class="fa fa-heart " style="color: red"></i>
                                    <h5> &nbsp; {{__('Wishlist')}}
                                        @if($count_wishlist )
                                            <span class="menu-collapsed"><span class="badge badge-pill badge-danger ml-2">{{$count_wishlist}}</span></span>
                                        @endif
                                    </h5>
                                </a>
                                <a  class="dropdown-item d-flex fa-2x" href="{{route('settings')}}">
                                    <i class="fa fa-cog"></i> <h5> &nbsp; Settings</h5>
                                </a>
                                <hr>
                                <a class="dropdown-item d-flex fa-2x" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out "></i>     <h5>&nbsp; {{ __('Logout') }}</h5>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg   navigation_bar " style="max-height: 55px;">
        @if(url()->current()  ==  URL::to('/')   )
            <a class="navbar-brand text-warning" href="#"><h4 class="ml-3">Home , sweet home!</h4></a>

        @elseif(!empty(env('APP_URL')))
            <a class="navbar-brand text-warning "  href="#">
                <h4 class="ml-3">{{Str::ucfirst(Str::after(url()->current(),env('APP_URL').'/'))}}</h4></a>
        @endif

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon ">
                <i class="fas fa-bars" style="color:#fff; font-size:28px;"></i>
            </span>
        </button>

        {{--        @if(  Auth::check())--}}
        <div class="collapse navbar-collapse  offset-1 " id="collapsibleNavbar" style="background-color:#5E35B1 ">
            <ul class="nav navbar-nav" style="margin-top: -1px">
                {{--                    <div class="offset-lg-2">--}}
                <li class="nav-item dropdown  navbar-brand ml-5" id="navbar_dropdown_agencies">
                    <a class="nav-link dropdown-toggle text-white agencies_navbar" id="navbarDropdown"
                       role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{__('Agencies')}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('agencies')}}">{{__('All Agencies')}}</a>
                        <a class="dropdown-item" href="{{route('popular-agencies')}}">Popular Agencies</a>

                        <a  class="dropdown-item" href="{{route('featured-agencies')}}">Our Suggestions</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('signup-an-agency')}}">{{__('Sign Up Agency')}}</a>
                    </div>
                </li>
                {{--                    <a class="navbar-brand text-white ml-5" href="{{route('guides')}}">{{__('Guides')}}</a>--}}
                <li class="nav-item dropdown   navbar-brand ml-5" id="navbar_dropdown_guides" >
                    <a class="nav-link dropdown-toggle text-white guides_navbar" href="{{route('guides')}}"
                       id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">  {{__('Guides')}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('guides')}}">All Guides</a>
                        <a class="dropdown-item" href="{{route('popular-guides')}}">Popular Guides</a>

                        <a class="dropdown-item" href="{{route('featured-guides')}}">Our Suggestions</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('become-tour-guide')}}">{{__('Become Tour Guide')}}</a>
                    </div>
                </li>
                {{--                    @endif--}}
                {{--                    @if( Auth::check())--}}
                {{--                            url()->current() !=  URL::to('/tours') &&--}}
                {{--                        <a class="navbar-brand text-white ml-5" href="{{route('tours')}}">{{__('Tours')}}</a>--}}
                <li class="nav-item dropdown   navbar-brand ml-5" id="navbar_dropdown_tours" >
                    <a class="nav-link dropdown-toggle text-white tours_navbar" href="{{route('tours')}}" id="navbarDropdown"
                       role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{__('Tours')}}
                    </a>
                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('tours')}}">All Tours</a></li>
                        <li><a class="dropdown-item" href="{{route('popular-tours')}}">Popular Tours</a></li>
                        <a href="{{route('featured-tours')}}" class="dropdown-item">Our Suggestions</a>

                        {{--                        <li><a class="dropdown-item"  href="#"></a></li>--}}

{{--                        <a href="" class="dropdown-item dropdown-toggle" data-toggle="dropdown" >--}}
                        <div class="dropdown-divider"></div>
{{--                        <li class="dropdown-item">Our Suggestions</li>--}}
                        <li><a class="dropdown-item" href="{{route('tour.search-filter')}}">Advanced Search Tours</a></li>

                        {{--                        </a>--}}
{{--                        <ul class="dropdown-menu" style="margin-top: -43%;margin-left: 100%;">--}}
{{--                            <li>--}}
{{--                                <?php $featured_tours = \App\Tour::whereFeatured(1)->whereStatus('active')->get(); ?>--}}
{{--                                @foreach($featured_tours as $featured_tour)--}}
{{--                                    <a href="{{route('tour.{title}',Str::slug($featured_tour->title,'-'))}}"--}}
{{--                                       class="dropdown-item">{{$featured_tour->title}}</a>--}}
{{--                                @endforeach--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                        <li class="dropdown-divider"></li>--}}

{{--                        todo --}}
                        {{--                                <li><a class="dropdown-item" href="#"></a></li>--}}

                        {{--                                <a href="#" class="dropdown-item dropdown-toggle" data-target="#collapseOne" aria-expanded="true"--}}
                        {{--                                   aria-controls="collapseOne">Country</a>--}}

                        {{--                                <ul class="dropdown-menu" style="margin-top: -43%;margin-left: 100%;"  id="collapseOne">--}}
                        {{--                                    <li>--}}
                        {{--                                        <?php $countries = DB::table('countries')->get(); ?>--}}
                        {{--                                        @foreach($countries as $country)--}}
                        {{--                                            <a href="{{$country->name}}" class="dropdown-item">{{$country->name}}</a>--}}
                        {{--                                        @endforeach--}}
                        {{--                                    </li>--}}
                        {{--                                </ul>--}}



                        {{--                                <a href="#" class="dropdown-item dropdown-toggle" data-toggle="dropdown"--}}
                        {{--                                   aria-expanded="true" data-target="#countries">Country</a>--}}
                        {{--                                <ul class="dropdown-menu " id="countries"    >--}}
                        {{--                                    <li >--}}
                        {{--                                        <?php $countries = DB::table('countries')->get(); ?>--}}
                        {{--                                        @foreach($countries as $country)--}}
                        {{--                                            <a href="{{$country->name}}" class="dropdown-item">{{$country->name}}</a>--}}
                        {{--                                        @endforeach--}}
                        {{--                                    </li>--}}
                        {{--                                </ul>--}}

                    </ul>
                </li>
                {{--                    </div>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a class="nav-link text-white" href="#">Link</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a class="nav-link text-white" href="#">Link</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a class="nav-link text-white" href="#">Link</a>--}}
                {{--                        </li>--}}
            </ul>
        </div>
        {{--        @endif--}}

    </nav>

</div>

