<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poker;
use App\Http\Requests;
use App\Services\DealService;
use Session;

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
     * @param array Poker $poker
     * @return array $myHand
     * @return array $cpHand
     */
    public function select(Poker $poker)
    {
        $myHand = $poker->getHand($poker->getTrump());
        $kitty = $poker->getKitty($poker->getTrump());
        $convert = $poker->convertToCanJudge($myHand);
        $myRank = $poker->getYaku($convert);
        Session::put('kitty', $kitty);

        return view('poker/select')->with('data', [
                'myHand' => $myHand,
                'myRank' => $myRank
        ]); 
    }

    /**
     * 勝敗判定画面
     *
     * @param array Request $request
     * @param array Poker $poker
     * @return array $myHand
     * @return 
     */
    public function judge(Request $request, Poker $poker)
    {
        $myHand = $poker->drawCards($request->input('myHand'), Session::get('kitty'), $request->input('discardKey'), $request->input('holdCardKey'));

        return view('poker/judge')->with(
            'data', [
                'myHand' => $myHand
            ]
        );
    }
}
