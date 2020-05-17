@extends('base')

@section('content')


<div>
    <button class="btn"><i class="fa fa-home"></i></button> 
    <div>
        TRIPS ({{$count}})
    </div>
</div>


@foreach ($trips as $trip)
    <div>
        <div>
            {{$trip->requestTime}}
        </div>

        <div>
            {{$trip->finalPrice}} KES 
        <div>    

        @php $rating = $trip->rate; @endphp  

        @foreach(range(1,5) as $i)
                    <span class="fa-stack" style="width:1em">
                        <i class="far fa-star fa-stack-1x"></i>

                        @if($rating >0)
                            @if($rating >0.5)
                                <i class="fas fa-star fa-stack-1x"></i>
                            @else
                                <i class="fas fa-star-half fa-stack-1x"></i>
                            @endif
                        @endif
                        @php $rating--; @endphp
                    </span>
        @endforeach

        <div>
            Pickup Location: {{$trip->pickUpLocation}}
        </div>    

        <div>
            Dropoff Location: {{$trip->dropOffLocation}}
        </div>     

        Status: 
        @php $status = $trip->status; @endphp  

        @if($status == 1)
            Completed
        @else
            Cancelled     
        @endif
        
    </div>
@endforeach

@endsection 