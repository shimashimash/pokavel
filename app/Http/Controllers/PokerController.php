<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poker;
use App\Http\Requests;
use App\Services\PokerService;

class PokerController extends Controller
{
	public function __construct(PokerService $pokerService)
	{
		$this->pokerService = $pokerService;
	}

    public function standby()
    {
    	$trump1 = $this->pokerService->getTrump();
    	$trumps = $this->pokerService->getHand($trump1);
    	return view('poker.standby')->with(compact('trumps'));
    }
}
