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
     * @return array $myHand
     * @return array $cpHand
     */
    public function judge(Request $request)
    {
        //山札をセッションから取得する
        $kitty = Session::get('kitty');
        //送られてきたトランプの数を数える
        $countPostedTrump = count($request->input('myHand'));
        if ($countPostedTrump == 5) {
            $myHand = $request->input('myHand');
        } else {
            $countDraw = 5 - $countPostedTrump;
            $drawCards = array_slice($kitty, 0, $countDraw, true);
            $inputMyHand = $request->input('myHand');
            foreach ($drawCards as $value) {
                $addTrump[] = '/image_trump/gif/'. $value. '.gif';
            }
             $myHand = array_merge($inputMyHand, $addTrump);
        }
        $input = $request->input('key');
        return view('poker/judge')->with('data', [
                'myHand' => $myHand,
                'input' => $input
        ]);
    }
}
