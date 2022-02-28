<x-app-layout>

    <x-slot name="header">
        <div class="row">
            <a class="btn btn-primary col-2" href="{{route('customers')}}">مشتریان</a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight col-10" style="direction: rtl">
                {{ __('پنل').' '.($user->name) }}
            </h2>
        </div>

    </x-slot>

    <div class="py-12 " style="direction:rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {!! Form::open(['method'=>'POST','action'=>'HomeController@createCustomer']) !!}
                    <div class="row">
                        <div class="form-group col-4">
                            {!! Form::text('username',null,['class'=>'form-control','placeholder'=>'نام کاربری ']) !!}
                        </div>
                        <br>
                        <div class="form-group col-4">
                            {!! Form::text('password',null,['class'=>'form-control','placeholder'=>'رمز عبور ']) !!}
                        </div>

                        <div class="form-group col-2">
                            {!! Form::submit('اضافه کردن مشتری ',['class'=>'btn btn-success']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}

                    <br>
                    <div class="row">
                        <h5 class="col-3">نام کاربری</h5>
                        <h5 class="col-3">رمز عبور</h5>
                    </div>
                    <div class="border border-1 w-50"></div>
                    @forelse($customers as $customer)
                        <div class="row">
                            <h5 class="col-3">{{$customer->username}}</h5>
                            <h5 class="col-3">{{$customer->password}}</h5>
                        </div>
                    @empty
                        <h5 class="text-center " style="background-color: #bbbfbb">
                            شما  در حال حاضر هیچ مشتری ندارید!
                        </h5>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
