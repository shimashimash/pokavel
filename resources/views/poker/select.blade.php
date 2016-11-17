@extends('layouts.app')

@section('content')
{!! Form::open(['action' => 'PokerController@judge', 'method' => 'post', 'id' => 'holdSrcForm']) !!}
    <div class="wrapper">
        <div class="myField">
            @foreach($data['myHand'] as $key => $value)
                <div class="myCard">
                    {{ Html::image('/image_trump/gif/'. $value. '.gif', 'あなたの手札', ['class' => 'trumpImg']) }}
                    {!! Form::hidden('hand[]', '/image_trump/gif/'. $value. '.gif') !!}
                    {!! Form::hidden('discardKey[]', $key) !!}
                	<div class="mask" style="display: none;">
                   		<div class="caption">Hold!</div>
            		</div>
        		</div>
    		@endforeach
        </div>
        <div class="rank">
        		{{ $data['myRank'] }}
        </div>
        <div class="judgeBtn button"><a href="javascript:void(0);"><button>JUDGE</button></a></div>
        <div>所持コイン：{{ $data['userHaveCoin'] }}枚</div>
        <div>かけるコインの数を決めてください {{ Form::select('bet', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10']) }}</div>
    </div>
    {!! Form::hidden('_token', csrf_token()) !!}
{!! Form::close() !!}
@endsection