@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    ようこそ、{{ $userName }}さん
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">GAME</div>
                <div class="panel-body">
                	    Pokavel
                    <div style="float: right;">
                    	    {{ link_to('/poker/start', 'PLAY', ['class' => 'btn btn-primary']) }}
					</div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">{{ $userName }}さんの所有コイン</div>
                <div class="panel-body">
                	    {{ $userHaveCoin }}コイン
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
