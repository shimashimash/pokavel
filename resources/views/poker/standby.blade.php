@extends('layouts.app')

@section('content')
<style>
.wrapper {
	width: 100%;
	height: 1000px;
	background: green;
}
</style>
<div class="wrapper">
	<?php var_dump($trumps); ?>
	            @foreach ($trumps as $trump)
                    <img src="./image_trump/gif/{{ $trump['mark']}}_{{ $trump['number'] }}.gif" class="trump-img" alt="あなたの手札">
                @endforeach
</div>
@endsection