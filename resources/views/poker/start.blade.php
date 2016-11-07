@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="myField">
    @for($i=0; $i<5; $i++)
    		<img src="/image_trump/gif/z02.gif" class="trump-img" alt="あなたの手札" width="125" height="150">
    	@endfor
    </div>
    <div class="startBtn button"><a href="/poker/select"><button>START</button></a></div>
</div>
@endsection