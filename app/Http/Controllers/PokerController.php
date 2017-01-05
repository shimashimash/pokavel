<?php
namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\Poker;
use Session;
use DB;

/**
 * ポーカーの画面処理全般
 *
 */
class PokerController extends Controller
{
    public function __construct(Poker $poker, Request $request)
    {
        $this->poker = $poker;
        $this->user  = $request->user();
    }

    /**
     * 初期表示画面
     *
     * @return Response
     */
    public function start()
    {
        return view('poker/start');
    }

    /**
     * カード選択画面
     *
     * @return Response
     */
    public function select()
    {
        // 手札を取得する
        $trump   = $this->poker->getTrump();
        $myHand  = $this->poker->getHand($trump);
        $kitty   = $this->poker->getKitty($trump);
        $myRank  = $this->poker->getYaku($this->poker->convertToCanJudge($myHand));
        Session::put('kitty', $kitty);

        return view('poker/select')->with('data', ['myHand' => $myHand, 'myRank' => $myRank,]);
    }

    /**
     * 勝敗判定画面
     *
     * @param array Request $request
     * @return Response
     */
    public function judge(Request $request)
    {
        // 二重送信対策
        Session::regenerateToken();

        // カードの結果を表示する
        if ($request->input('myHand')) {
            // holdされたカードがあるときの処理
            $myHand = $this->poker->drawCards($request->input('myHand'), Session::get('kitty'), $request->input('discardKey'), $request->input('holdCardKey'));
        } else {
            // holdされたカードがないときの処理
            $countMyHand = count($request->input('hand'));
            $drawFromKitty = array_slice(Session::get('kitty'), 0, $countMyHand);
            foreach($drawFromKitty as $value) {
                $myHand[] = '/image_trump/gif/'. $value. '.gif';
            }
        }

        // 役判定できるように手札を変換
        $convertCards = $this->poker->convertToCanJudge($this->poker->replaceMyHand($myHand));

        // 役判定
        $myRank = $this->poker->getYaku($convertCards);

        // コイン算出
        $resJudge = (int) $this->poker->getJudge($convertCards);
        $resultCoin = config('app.judge.resultPoint.'.$resJudge);
        $getCoin = $request->input('bet') * $resultCoin;
        $totalCoin = $this->poker->coinManagement($this->user, $request->input('bet'), $resultCoin);

        // DB情報をアップデート
        DB::table('users')
            ->where('id', $this->user->id)
            ->update(['coin' => $totalCoin]);

        return view('poker/judge')->with(
                'data',
                [
                    'myHand' => $myHand,
                    'myRank' => $myRank,
                    'getCoin' => $getCoin,
                    'totalCoin' => $totalCoin,
                ]
        );
    }


    public function getAjax()
    {
        return view('poker/start');
    }
}
