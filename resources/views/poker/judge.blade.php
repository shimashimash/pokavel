@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="myField">
        @foreach($data['myHand'] as $value)
            <div class="myCard">
                {{ Html::image($value, 'あなたの手札', ['class' => 'trumpImg']) }}
    		</div>
		@endforeach
    </div>
    <div class="rank">
    		{{ $data['myRank'] }}
    </div>
</div>
@endsection