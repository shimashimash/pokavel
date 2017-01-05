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
    <div class="">
        @if (0 < $data['getCoin'])
            <p>おめでとうございます！{{ $data['getCoin'] }}ポイントを手に入れました！</p>
        @else
            <p>残念でした！</p>
        @endif
    </div>
    <div>
        <a href="/poker/select">もう一回！</a>
    </div>
</div>
@endsection