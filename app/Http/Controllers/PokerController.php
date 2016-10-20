<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poker;
use App\Http\Requests;
use App\Services\DealService;

class PokerController extends Controller
{
	public function __construct(DealService $dealService)
	{
		$this->deal= $dealService;
	}

    public function standby()
    {
        return view('poker/standby')->with(compact('myHand', 'cpHand'));
    }
    
    public function playPoker()
    {
        $getTrump = $this->deal->getTrump();
        $myHand = $this->deal->getHand($getTrump);
        $cpHand = $this->deal->getCpHand($getTrump);
        return view('poker/playPoker')->with(compact('myHand', 'cpHand')); 
    }
}
