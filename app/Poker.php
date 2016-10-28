<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poker extends Model
{
    /**
     * トランプを返却
     * @return $trump シャッフルされたトランプ
     */
    public function getTrump() {
        return $this->shuffleTrump();
    }
    
    /**
     * 自分の手札を返却
     * @param $trump シャッフルされたトランプ
     * @return $myhands 自分の手札
     */
    public function getHand($trump) {
        $myhands = array_slice($trump, 0, 5, true);
        return $myhands;
    }
    
    /**
     * cpの手札を返却
     * @param $trump シャッフルされたトランプ
     * @return $cphands cpの手札
     */
    public function getCpHand($trump) {
        $cphands = array_slice($trump, 5, 5, true);
        return $cphands;
    }
    
    /**
     * 山札を返却
     * @param $trump シャッフルされたトランプ
     * @return $kitty 山札
     */
    public function getKitty($trump) {
        $kitty = array_slice($trump, 10, 42, true);
        return $kitty;
    }
    /**
     * セッションの開始
     */
    public function sessionStart() {
        session_start();
    }
    
    /**
     * セッションの終了
     */
    public function clearSession() {
        $_SESSION = '';
        session_destroy();
    }
    
    /**
     * 山札をセッションに格納
     *
     */
    public function setSession($kitty, $cphands, $cpRank, $cpResult) {
        $_SESSION['kitty'] = $kitty;
        $_SESSION['cphands'] = $cphands;
        $_SESSION['cpRank'] = $cpRank;
        $_SESSION['cpResult'] = $cpResult;
    }
    
    // ********************************************************************************************
    //
    // これよりプライベートメソッド
    //
    // ********************************************************************************************
    
    /**
     * トランプをシャッフルして返却
     * @param
     * @return $trump シャッフルされたトランプ
     */
    private function shuffleTrump() {
        $trump = array();
        $marks = array('spades', 'hearts', 'diams', 'clubs');
        foreach($marks as $mark) {
            for($i=1; $i <= 13; $i++){
                $trump[] = array(
                        'number' => $i,
                        'mark' => $mark
                );
            }
        }
        shuffle($trump);
    
        return $trump;
    }
}
