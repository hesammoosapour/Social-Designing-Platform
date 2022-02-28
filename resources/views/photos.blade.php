<x-app-layout>
    @section('styles')
        <style>
            .card_2_row {
                height: 300px;
                width: 500px ;
            }
        </style>
    @stop

    <x-slot name="header">
        <div class="row">
            <a class="btn btn-primary col-2" href="{{route('customers')}}">مشتریان</a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight col-10" style="direction: rtl">
                {{ __('صفحه طراح').' '.($designer->name)." : " }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 " style="direction:rtl">
        @if(session('invalid-credentials'))
            <h4 class="text-center  alert-danger ">نام کاربری یا رمز عبور اشتباه است!</h4>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-public-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-public" type="button" role="tab"
                                    aria-controls="pills-public" aria-selected="true">عمومی
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-private-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-private" type="button" role="tab"
                                    aria-controls="pills-private" aria-selected="false">خصوصی
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-public" role="tabpanel" aria-labelledby="pills-public-tab">
                            {{--عمومی--}}
                            <div class="row ">
                                <div class=" d-flex   ">
                                    @forelse($designer_photos as $designer_photo)
                                        @php
                                            $privacy = DB::table('media')->where('uuid',$designer_photo->uuid)->first('privacy')->privacy ;
                                        @endphp
                                        @if($privacy == 'public')
                                            <div class="card " >
                                                <img src="{{$designer_photo->getUrl('card')}}" class="img-fluid card_2_row" alt="">
                                                <div class="card-body row">
                                                    <div class="col-10">
                                                        <a href="{{$designer_photo->getUrl()}}">
                                                            <i class="text-info fas fa-eye fa-2x" title="مشاهده عکس"></i></a>
                                                    </div>
                                                    <div class="col-2">
                                                        <i class=" <?= $designer_photo->privacy == 'private'
                                                            ? 'fab fa-accessible-icon' : 'fa fa-universal-access' ?>
                                                            fa-2x"    aria-hidden="true" title="<?= $designer_photo->privacy == 'private' ?
                                                            'دسترسی خصصوی' : 'دسترسی عمومی' ?>"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    @empty
                                        <h5 class="text-center " style="background-color:#c1c5c1">هیچ عکسی یافت نشد!</h5>
                                    @endforelse
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-private" role="tabpanel" aria-labelledby="pills-private-tab">
                            {{--خصوصی--}}
                            <div class="row ">
                                <div class=" d-flex   ">
                                    <?php
                                    $session_customer = \Illuminate\Support\Facades\Session::get('customer-designer-'.$designer->id);
                                    ?>

                                    @if((isset($user) && $user->hasRole("Admin"))
                                        || (isset($designer) && isset($user) && $designer->id == $user->id)
                                        || (isset($session_customer)) )

                                        @forelse($designer_photos as $designer_photo)
                                            @php
                                                $privacy = DB::table('media')->where('uuid',$designer_photo->uuid)->first('privacy')->privacy ;
                                            @endphp
                                            @if($privacy == 'private')
                                                <div class="card " >
                                                    <img src="{{$designer_photo->getUrl('card')}}" class="img-fluid card_2_row" alt="">
                                                    <div class="card-body row">
                                                        <div class="col-10">
                                                            <a href="{{$designer_photo->getUrl()}}">
                                                                <i class="text-info fas fa-eye fa-2x" title="مشاهده عکس"></i></a>
                                                        </div>
                                                        <div class="col-2">
                                                            <i class=" <?= $designer_photo->privacy == 'private'
                                                                ? 'fab fa-accessible-icon' : 'fa fa-universal-access' ?>
                                                                fa-2x"    aria-hidden="true" title="<?= $designer_photo->privacy == 'private' ?
                                                                'دسترسی خصصوی' : 'دسترسی عمومی' ?>"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        @empty
                                            <h5 class="text-center " style="background-color:#c1c5c1">هیچ عکسی یافت نشد!</h5>
                                        @endforelse

                                    @else

                                    <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-secondary text-center"
                                                data-bs-toggle="modal" data-bs-target="#customerLogin">
                                            ورود به عنوان مشتری
                                        </button>

                                        <!-- Vertically centered modal -->
                                        <div class="modal fade" id="customerLogin" tabindex="-1" aria-labelledby="customerLoginLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="customerLoginLabel">ورود به عنوان مشتری:</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {!! Form::open(['method'=>'POST','action'=>'HomeController@customerLogin']) !!}
                                                        <div class="form-group">
                                                            {!! Form::text('username',null,['class'=>'form-control','placeholder'=>'نام کاربری']) !!}
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            {!! Form::text('password',null,['class'=>'form-control','placeholder'=>'رمز عبور']) !!}
                                                        </div>
                                                        <input type="hidden" name="designerID" value="{{$designer->id}}">
                                                        <div class="form-group modal-footer">
                                                            {!! Form::submit('ورود',['class'=>'btn btn-primary']) !!}
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                                                        </div>

                                                        {!! Form::close() !!}
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
