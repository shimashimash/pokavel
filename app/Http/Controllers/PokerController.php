<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poker;
use App\Http\Requests;
use App\Services\DealService;

class PokerController extends Controller
{
	public function __construct(Poker $poker)
	{
		$this->poker = $poker;
	}

	/**
	 * 初期表示画面
	 *
	 */
    public function start()
    {
        return view('poker/start');
    }

    /**
     * カード選択画面
     *
     * @return array $myHand
     * @return array $cpHand
     */
    public function select(Poker $poker)
    {
        $getTrump = $poker->getTrump();
        return view('poker/select')->with('data', [
                'myHand' => $poker->getHand($getTrump),
                'cpHand' => $poker->getCpHand($getTrump)
        ]); 
    }

    /**
     * 勝敗判定画面
     *
     * @return array $myHand
     * @return array $cpHand
     */
    public function judge(Request $request)
    {
        return view('poker/judge')->with('data', [
                'myHand' => $request->input('holdSrc'),
                'cpHand' => $request->input('cpHand')
        ]);
    }
}
