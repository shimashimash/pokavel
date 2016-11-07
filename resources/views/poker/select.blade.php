@extends('layouts.app')

@section('content')
<form action="/poker/judge" method="post" id="holdSrcForm">
    <div class="wrapper">
        <div class="myField">
            @foreach($data['myHand'] as $key => $value)
                <div class="myCard">
                    <img src="/image_trump/gif/{{ $value }}.gif" class="trump-img" alt="あなたの手札" width="125" height="150">
                    <input type="hidden" value="/image_trump/gif/{{ $value }}.gif" name="myHand[]">
                    <input type="hidden" value="{{ $key }}" name="discardKey[]">
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
    </div>
	<input type="hidden" value="{{ csrf_token() }}" name="_token">
</form>
@endsection