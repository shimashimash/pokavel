<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poker;
use App\Http\Requests;
use Session;

/**
 * ポーカーの処理全般
 *
 */
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
    public function select(Poker $poker, Request $request)
    {
        // ユーザー情報を取得する
        $user = $request->user();

        // 手札を取得する
        $trump = $poker->getTrump();
        $myHand = $poker->getHand($trump);
        $kitty = $poker->getKitty($trump);
        $convert = $poker->convertToCanJudge($myHand);
        $myRank = $poker->getYaku($convert);
        Session::put('kitty', $kitty);

        return view('poker/select')->with(
                'data', [
                        'myHand' => $myHand,
                        'myRank' => $myRank,
                        'userHaveCoin' => $user->coin
                ]
        ); 
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
        if ($request->input('myHand')) {
            // holdされたカードがあるときの処理
            $myHand = $poker->drawCards($request->input('myHand'), Session::get('kitty'), $request->input('discardKey'), $request->input('holdCardKey'));
        } else {
            // holdされたカードがないときの処理
            $countMyHand = count($request->input('hand'));
            $drawFromKitty = array_slice(Session::get('kitty'), 0, $countMyHand);
            foreach($drawFromKitty as $value) {
                $myHand[] = '/image_trump/gif/'. $value. '.gif';
            }
        }
        $replaceMyHand = str_replace('/image_trump/gif/', '', $myHand);
        $convertCards = $poker->convertToCanJudge($replaceMyHand);
        $myRank = $poker->getYaku($convertCards);
        
        return view('poker/judge')->with(
            'data', [
                'myHand' => $myHand,
                'myRank' => $myRank
            ]
        );
    }
}
