@if(count($errors) > 0 )

    <div class="alert alert-danger">

        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>


                @if($error == 'Remained Capacity For This Tour Is :0')
                    <div class="alert alert-info">
                        {{'Check Out Alternative Tours ,'}}
                        <a href="{{route('tour.{title}.alt-tours-city',Str::slug($tour->title,'-'))}}">here</a>
                    </div>
                @endif


                @if($error == 'Guide Is Busy.Try Another Date Or Try These Alternative Guides In City :')
                    <a href="{{route('guide.{id}.alt-guides-city',$guide->id)}}"> here </a>
                @endif

                @if($error == "Tour Isn't Hold That Day.Try Another Date Or Try These Alternative Tours In City :")
                    <a href="{{route('tour.{title}.alt-tours-city',Str::slug($tour->title,'-'))}}"> here </a>
                @endif

            @endforeach

        </ul>

    </div>

@endif
