@extends('base') 

@section('content')

<h1>SEARCH TRIP</h1>


<div class="well">
    {!! Form::open(['url' => '/search', 'class' => 'form-horizontal']) !!}
    <!-- search by keyword -->
    <div class="form-group">
            {!! Form::label('keyword', 'Search:', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::text('keyword', $value = null, ['class' => 'form-control', 'placeholder' => 'keyword']) !!}
            </div>
    </div>

    <!-- checkbox for include cancelled trips -->
    <div class="form-group">
            <div class="checkbox">    
                {!! Form::label('cancelledTrips', 'Include cancelled trips') !!}
                {!! Form::checkbox('cancelledTrips') !!}
            </div>
    </div>

    <!-- trip distance options / radios -->
    <div class="form-group">
    {!! Form::label('radios', 'Trip Distances', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                <div class="radio">
                    {!! Form::label('Any', 'Any') !!}
                    {!! Form::radio('radioDistance', 'Any', true, ['id' => 'Any']) !!}
                </div>
                <div class="radio">
                    {!! Form::label('lessthan3', 'Less than 3 Km.') !!}
                    {!! Form::radio('radioDistance', '1', false, ['id' => 'lessthan3']) !!}
                </div>
                <div class="radio">
                    {!! Form::label('3-8', '3 to 8 Km.') !!}
                    {!! Form::radio('radioDistance', '3-8', false, ['id' => '3-8']) !!}
                </div>

                <div class="radio">
                    {!! Form::label('8-15', '8 to 15 Km.') !!}
                    {!! Form::radio('radioDistance', '8-15', false, ['id' => '8-15']) !!}
                </div>

                <div class="radio">
                    {!! Form::label('above15', 'Above 15 Km.') !!}
                    {!! Form::radio('radioDistance', '1000', false, ['id' => 'above15']) !!}
                </div>
            </div>
    </div>


    <!-- trip time options /radios  -->
    <div class="form-group">
    {!! Form::label('radios', 'Trip Times', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                <div class="radio">
                    {!! Form::label('Any', 'Any') !!}
                    {!! Form::radio('radioTime', 'Any', true, ['id' => 'Any']) !!}
                </div>
                <div class="radio">
                    {!! Form::label('lessthan5', 'Under 5 mins') !!}
                    {!! Form::radio('radioTime', '1', false, ['id' => 'lessthan5']) !!}
                </div>
                <div class="radio">
                    {!! Form::label('5-10', '5 to 10 mins') !!}
                    {!! Form::radio('radioTime', '5-10', false, ['id' => '5-10']) !!}
                </div>

                <div class="radio">
                    {!! Form::label('10-20', '10 to 20 mins') !!}
                    {!! Form::radio('radioTime', '10-20', false, ['id' => '10-20']) !!}
                </div>

                <div class="radio">
                    {!! Form::label('above20', 'Above 20 mins') !!}
                    {!! Form::radio('radioTime', '100', false, ['id' => 'above20']) !!}
                </div>
            </div>
    </div>
    
    <!-- search button  -->
    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
                {!! Form::submit('Search', ['class' => 'btn btn-lg btn-info pull-right'] ) !!}
        </div>
    </div>


    {!! Form::close()  !!}

</div>
@endsection
