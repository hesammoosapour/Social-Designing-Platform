<x-app-layout>
    <x-slot name="header">
        @include('inclusion.header-admin')
    </x-slot>

    @section('content')
        <button onclick="historyBackWFallback()" class="btn btn-warning ms-2 mt-2">
            <i class="fa fa-step-backward"></i>
        </button>

        <div class="rtl p-2">
            <h3>ویرایش کاربر  {{$user->name}}</h3>
            <div class="row">

                @include('inclusion.form-error')
                @if(session('updated_user'))
                    <div class=" text-center">
                        <h5 class="alert alert-success">{{session('updated_user')}}</h5>
                    </div>
                @endif

            </div>
            <div class="row">
                <div class="col-12 col-sm-3">
                    <img src="" alt="" class="img-responsive img-rounded">
                </div>

                <div class="col-12 col-sm-7">
                    {{--Update ----}}
                    <div class="">
                        <h4>ایمیل : {{$user->email}} </h4>
                        <h4>همراه : {{$user->phone}} </h4>
                    </div>
                    {!! Form::model($user, ['method'=>'PATCH', 'action'=> ['AdminController@userUpdate', $user->username],'files'=>true]) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::text('name', null, ['class'=>'form-control'])!!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('username', 'Username:') !!}
                        {!! Form::text('username', null, ['class'=>'form-control'])!!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('role_id', 'Role:') !!}
                        {!! Form::select('role_id',  $roles_available , $user_role_id, ['class'=>'form-control'])!!}
                    </div>
                    <br>
                    <div class="form-group">
                        {!! Form::submit('به روز رسانی کاربر', ['class'=>'btn btn-primary col-sm-6 col-lg-3']) !!}
                    </div>
                    {!! Form::close() !!}


                    {{--Delete  -------------------------------------------------------------------------------------------------}}
                    {{--                {!! Form::open(['method'=>'DELETE', 'action'=> ['AdminUsersController@destroy', $user->id]]) !!}--}}
                    {{--                <div class="form-group">--}}
                    {{--                    {!! Form::submit('Delete user', ['class'=>'btn btn-danger col-sm-6 col-lg-3 pull-right']) !!}--}}
                    {{--                </div>--}}
                    {{--                {!! Form::close() !!}--}}

                </div>
            </div>
        </div>
    @stop

    @section('scripts')
        <script type="text/javascript">
            function historyBackWFallback(fallbackUrl) {
                fallbackUrl = fallbackUrl || "{{route('admin.users')}}";
                var prevPage = window.location.href;

                window.history.go(-1);
                setTimeout(function(){
                    if (window.location.href == prevPage) {
                        window.location.href = fallbackUrl;
                    }
                }, 500);
            }
        </script>
    @stop
</x-app-layout>
