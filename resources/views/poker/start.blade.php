@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="myField">
        @for($i=0; $i<5; $i++)
            {{ Html::image('/image_trump/gif/z02.gif', 'トランプ', ['class' => 'trumpImg']) }}
    	@endfor
    </div>
    <div class="startBtn button"><a href="/poker/select"><button id="start">START</button></a></div>
</div>
@endsection