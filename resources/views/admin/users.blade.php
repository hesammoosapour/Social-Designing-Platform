<x-app-layout>
    <x-slot name="header">
        @include('inclusion.header-admin')
    </x-slot>

    @section('content')
        <button onclick="historyBackWFallback()" class="btn btn-warning ms-2 mt-2">
            <i class="fa fa-step-backward"></i>
        </button>
        <div class="rtl p-2">
            @if(Session::has('deleted_user'))
                <p class=" label-danger">{{session('deleted_user')}}</p>
            @endif
            <h1>کاربران</h1>
                <hr>
            <table class="table ">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Deleted</th>
                </tr>
                </thead>
                <tbody>

                @if($users)
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td><a href="{{route('admin.{username}', $user->username)}}">{{$user->name}}</a></td>
                            <td><a href="{{route('admin.{username}', $user->username)}}">{{$user->username}}</a></td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->getRoleNames()}}</td>
                            <td class="ltr text-end">{{$user->created_at->diffForHumans()}}</td>
                            <td class="ltr text-end">{{$user->updated_at->diffForHumans()}}</td>
                            <td class="ltr text-end">{{$user->deleted_at ? $user->deleted_at->diffForHumans() : ''}}</td>
                        </tr>
                    @endforeach
                @endif

                </tbody>
            </table>


            <div class="row">
                <div class="col-sm-6 col-sm-offset-5">
                    {{$users->render()}}
                </div>
            </div>
        </div>
    @stop

    @section('scripts')
        <script type="text/javascript">
            function historyBackWFallback(fallbackUrl) {
                fallbackUrl = fallbackUrl || "{{route('panel')}}";
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
