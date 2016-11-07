@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="myField">
        @foreach($data['myHand'] as $value)
            <div class="myCard">
                <img src="{{ $value }}" class="trump-img" alt="あなたの手札" width="125" height="150">
    		    </div>
		@endforeach
    </div>
    <div class="rank">
    		{{ $data['myRank'] }}
    </div>
</div>
@endsection