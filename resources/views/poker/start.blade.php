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
</style>
<div class="wrapper">
    <div class="myField">
    @for($i=0; $i<5; $i++)
    		<img src="/image_trump/gif/z02.gif" class="trump-img" alt="あなたの手札" width="125" height="150">
    	@endfor
    </div>
    <div class="startBtn button"><a href="/poker/select"><button>START</button></a></div>
    <div class="enemyField">
        @for($i=0; $i<5; $i++)
            <img src="/image_trump/gif/z02.gif" class="trump-img" alt="相手の手札" width="125" height="150">
        @endfor
    </div>	
</div>
@endsection