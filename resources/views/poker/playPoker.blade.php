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
.startBtn {
    text-align: center;
}
.myCard, .cpCard {
    display: inline-block;
}
#holdShadow{
    display: none;
    width: 125px;
    height:150px;
    text-align: center;
    position: relative;
    top: 0;
    z-index: 100;
    background: rgba(0,0,0,0.7);
}
</style>
<div class="wrapper">
    <div class="myField">
    		@foreach($myHand as $value)
    		<div class="myCard">
			<img src="/image_trump/gif/{{ $value['mark'] }}_{{ $value['number'] }}.gif" class="trump-img" alt="あなたの手札" width="125" height="150">
			<div id="holdShadow">hold</div>
		</div>
		@endforeach
    </div>
    <div class="startBtn"><a href="/poker/judge"><button>JUDGE</button></a></div>
    <div class="enemyField">
    		@foreach($cpHand as $value)
    		<div class="cpCard">
			<img src="/image_trump/gif/{{ $value['mark'] }}_{{ $value['number'] }}.gif" class="trump-img" alt="あなたの手札" width="125" height="150">
		</div>
		@endforeach
    </div>

</div>
@endsection