<x-app-layout>
    @section('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
    @stop
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

                    <div class="container">
                        <h4>ایجاد پست جدید:</h4>
                        <a href="{{route('create-post')}}" type="button" class="btn btn-primary">پست جدید</a>

                        <h5>حداکثر تعداد آپلود: 100</h5>
                        <form action="/post/{{$post_id}}/new" method="post" class="dropzone"
                              multiple="multiple" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="d-flex form-group col-5 offset-4 ">
                                    <label class="col-3" for="designer_id">طراح ها:</label>
                                    <select class="form-control col-9" id="designer_id" name="designer_id"
                                            aria-label="designer_id">
                                        <option value="">انتخاب کنید :</option>
                                        @foreach($designers as $designer)
                                            <option value="{{$designer->id}}"> {{$designer->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <input class="form-check-input" name="set_private_only" type="checkbox" value="private-only" id="set-private-only">
                                    <label class="form-check-label" for="set-private-only">فقط خصوصی باشد</label>
                                </div>
                            </div>
                            <input type="hidden" name="post_id" value="{{$post_id}}">
                            <div class="form-group ">
                                <div class="d-flex">
                                    <h5>{!! Form::label('tag',' برچسب :') !!}</h5>
                                    <p>با ویرگول تگ ها را از یکدیگر جدا کنید!</p>
                                </div>
                                {!! Form::text('tag',null,['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group ">
                                <h5><label for="caption">کپشن:</label></h5>
                                <textarea name="caption" id="caption" class="form-control"></textarea>
                            </div>
                            <p>روی جعبه کلیک کنید برای اضافه کردن عکس ها :</p>
{{--                                                        <input type="file" name="file">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            {!! Form::submit('Create Post',['class'=>'btn btn-primary']) !!}--}}
{{--                                                        </div>--}}


                        </form>
                        <hr>
                        <a href="{{route('panel')}}" type="button" class="btn btn-primary">رفتن به پنل</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"  ></script>
    @stop
</x-app-layout>
