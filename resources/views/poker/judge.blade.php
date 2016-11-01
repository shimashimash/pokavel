@extends('layouts.app')

@section('content')
<style>
.wrapper {
	width: 100%;
	height: 1000px;
	background: green;
}
.myField, .enemyField {
    text-align: center;
}
.button {
    text-align: center;
}
.myCard, .cpCard {
    display: inline-block;
}
.myCard {
	width:			125px;
	height:			150px;
	overflow:		hidden;
	position:		relative;
}
.myCard .caption {
	font-size:		150%;
	text-align: 		center;
	color:			#fff;
	padding-top:60px;
}
.myCard .mask {
	width:			100%;
	height:			100%;
	position:		absolute;
	top:			0;
	left:			0;
	background-color:	rgba(0,0,0,0.4);
	-webkit-transition:	all 0.4s ease-out;
	transition:		all 0.4s ease-out;
}
</style>
<div class="wrapper">
    <div class="myField">
        @foreach($data['myHand'] as $value)
            <div class="myCard">
                <img src="{{ $value }}" class="trump-img" alt="あなたの手札" width="125" height="150">
            		<div class="mask" style="display: none;">
                		<div class="caption">Hold!</div>
        			</div>
    		</div>
		@endforeach
    </div>
    <div class="judgeBtn button">
    		<a href="javascript:void(0);"><button>JUDGE</button></a>
    	</div>
</div>
<?php var_dump($data['input']) ?>
@endsection