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
        $kitty = Session::get('kitty');
        $inputMyHand = $request->input('myHand');
        $discardKey = $request->input('discardKey');
        $holdCardKey = $request->input('holdCardKey');
        //$myHand = $poker->drawCards($request->input('myHand'), $kitty, $discardKey, $holdCardKey);
        // foreach ($discardKey as $value) {
        //     $addCardTest[$value] = 'hearts_'. $value;
        // }
        // $myHand = array_replace($myHand1, $addCardTest); 

        $countPostedTrump = count($inputMyHand);
        if ($countPostedTrump == 5) {
            $myHand = $inputMyHand;
        } else {
            $countDraw = 5 - $countPostedTrump;
            $drawCards = array_slice($kitty, 0, $countDraw, true);
            // foreach ($discardKey as $value) {
            //     foreach ($drawCards as $value => $value1) {
            //         $addCardTest[$value] = $value1;
            //     }
            // }
            // foreach ($holdCardKey as $value) {
            //     foreach ($inputMyHand as $value => $value1) {
            //         $holdCardTest[$value] = $value1;
            //     }
            // }
            for ($i=0; $i < $countDraw; $i++) { 
                $addCardTest[$discardKey[$i]] = $drawCards[$i];
            }
            for ($i=0; $i < $countPostedTrump; $i++) { 
                $addCardTest[$holdCardKey[$i]] = $inputMyHand[$i];
            }

            $myHand = array_replace($holdCardTest, $addCardTest); 
            // foreach ($drawCards as $value) {
            //     $addTrump[] = '/image_trump/gif/'. $value. '.gif';
            // }
        }



        return view('poker/judge')->with(
            'data', [
                'myHand' => $myHand,
                'addCardTest' => $addCardTest,
                'holdCardTest' => $holdCardTest
            ]
        );
    }
}
