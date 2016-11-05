<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poker extends Model
{
    private $poker;
    private $state = 0;
    private $name = [
            0 => "ロイヤルストレートフラッシュ",
            1 => "ストレートフラッシュ",
            2 => "フォーカード",
            3 => "フルハウス",
            4 => "フラッシュ",
            5 => "ストレート",
            6 => "スリーカード",
            7 => "ツーペア",
            8 => "ワンペア",
            9 => "ブタ"
    ];

    /**
     * トランプを返却
     * @return $trump シャッフルされたトランプ
     */
    public function getTrump() {
        return $this->shuffleTrump();
    }
    
    /**
     * 自分の手札を返却
     * @param array $trump シャッフルされたトランプ
     * @return array $myhands 自分の手札
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
//     public function getCpHand($trump) {
//         $cphands = array_slice($trump, 5, 5, true);
//         return $cphands;
//     }
    
    /**
     * 山札を返却
     * @param array $trump シャッフルされたトランプ
     * @return array $kitty 山札
     */
    public function getKitty($trump) {
        $kitty = array_slice($trump, 5, 42, true);
        return $kitty;
    }
    
    /**
     * 役の名前を返却
     * @param Array $cards
     * @return string
     */
    public function getYaku($cards) {
        $result = $this->judge($cards);
        $yaku = $this->getName($result);
        return $yaku;
    }
    
    /**
     * 役の値を返却
     * @param Array $cards
     * @return string
     */
    public function getJudge($cards) {
        $result = $this->judge($cards);
        return $result;
    }

    /**
     * 役判定できるように整形する
     * @param array $cards
     * @return array $result
     */
    public function convertToCanJudge($cards)
    {
        foreach($cards as $value) {
            $mark = strstr($value, "_", true);
            $number = preg_replace('/[^0-9]/', '', $value);
            $result[] = [
                    "number" => $number,
                    "mark" => $mark
            ];
        }
        return $result;
    }

    /**
     * カードを引く
     * @param Array $inputMyHand holdされた手札
     * @param Array $kitty 山札
     * @param Array $discardKey 捨てられたカードのkey
     * @param Array $holdCardKey holdされたカードのkey
     * @return Array $myHand 手札
     */
    public function drawCards($inputMyHand, $kitty, $discardKey, $holdCardKey)
    {
        $countPostedTrump = count($inputMyHand);
        if ($countPostedTrump == 5) {
            $myHand = $inputMyHand;
        } else {
            $countDraw = 5 - $countPostedTrump;
            $aaa = array_slice($kitty, 0, $countDraw);
            foreach ($aaa as $value) {
                $drawCards[] = '/image_trump/gif/'. $value. '.gif';
            }
            $addCard = $this->remakeCard($discardKey, $countDraw, $drawCards);
            $holdCard = $this->remakeCard($holdCardKey, $countPostedTrump, $inputMyHand);
            $apartMyHand = array_replace($holdCard, $addCard);
            //key順に並べ替える
            for ($i=0; $i<5; $i++) {
                $myHand[] = $apartMyHand[$i];
            }
        }
        return $myHand;
    }

    // ********************************************************************************************
    //
    // これよりプライベートメソッド
    //
    // ********************************************************************************************

    /**
     * keyにカードの値を代入する
     * @param array $key
     * @param int $countCard
     * @param array $cards
     * @return array $remakeCard
     */
    private function remakeCard($key, $countCard, $cards)
    {
        for ($i=0; $i<$countCard; $i++) {
            $remakeCard[$key[$i]] = $cards[$i];
        }
        return $remakeCard;
    }

    /**
     * トランプをシャッフルして返却
     * @param
     * @return $trump シャッフルされたトランプ
     */
    private function shuffleTrump() {
        $marks = ['spades', 'hearts', 'diams', 'clubs'];
        for($number=1; $number <= 13; $number++) {
            foreach($marks as $mark) {
                    $trump[] = $mark. '_'. $number;
            }
        }
        shuffle($trump);
    
        return $trump;
    }

    /**
     * 役の名前を取得
     * @param int
     * @return string
     */
    private function getName($state) {
        return $this->name[$state];
    }
    
    /**
     * 役の判定
     * @param Array $card
     * @return int
     */
    private function judge($cards) {
        if ($this->isRoyal($cards)) {
            return 0;
        }
        if ($this->isStraightFlash($cards)) {
            return 1;
        }
        if ($this->isFour($cards)) {
            return 2;
        }
        if ($this->isFullHouse($cards)) {
            return 3;
        }
        if ($this->isSameMark($cards)) {
            return 4;
        }
        if ($this->isStraight($cards)) {
            return 5;
        }
        if ($this->isThree($cards)) {
            return 6;
        }
        if ($this->isPair($cards)) {
            return 7;
        }
        if ($this->onePair($cards)) {
            return 8;
        }
        return 9;
    }
    
    /**
     * ロイヤルストレートフラッシュ判定
     */
    public function isRoyal($cards) {
        $state = false;
        $royal = array(1, 10, 11, 12 ,13);
        if($this->isStraightFlash($cards)) {
            foreach($cards as $card) {
                if(in_array($card["number"], $royal)) {
                    $state = true;
                } else {
                    $state = false;
                    break;
                }
            }
        }
        return $state;
    }
    
    /**
     * ストレートフラッシュ判定
     */
    private function isStraightFlash($cards) {
        return ($this->isStraight($cards) && $this->isSameMark($cards));
    }
    
    /**
     * フォーカード判定
     */
    private function isFour($cards) {
        $state = $this->searchPair($cards);
        rsort($state);
        if (array_shift($state) == 4) {
            return true;
        }
        return false;
    }
    
    /**
     * フルハウス判定
     */
    private function isFullhouse($cards) {
        $state = $this->searchPair($cards);
        rsort($state);
        if (array_shift($state) == 3 && array_shift($state) == 2) {
            return true;
        }
        return false;
    }
    
    /**
     * スリーカード判定
     */
    private function isThree($cards) {
        $state = $this->searchPair($cards);
        rsort($state);
        if (array_shift($state) == 3) {
            return true;
        }
        return false;
    }
    
    /**
     * ツーペア判定
     */
    private function isPair($cards) {
        $state = $this->searchPair($cards);
        rsort($state);
        if (array_shift($state) == 2) {
            if (array_shift($state) == 2) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * ワンペア判定
     */
    private function onePair($cards) {
        $state = $this->searchPair($cards);
        rsort($state);
        if (array_shift($state) == 2) {
            return true;
        }
        return false;
    }
    
    /**
     * 同じマークがあるか判定
     */
    private function isSameMark($cards) {
        $state = true;
        $mark = "";
        foreach ($cards as $card) {
            if ($mark !== "" && $mark !== $card["mark"]) {
                $state = false;
                break;
            }
            $mark = $card["mark"];
        }
        return $state;
    }
    
    /**
     * ストレート判定
     */
    private function isStraight($cards) {
        $numbers = array();
        foreach ($cards as $card) {
            $numbers[] = $card["number"];
        }
        $last = 0;
        sort($numbers);
        $state= true;
        foreach ($numbers as $number) {
            if($last == 1 && $number == 10) {
                $last = $number;
                continue;
            }
            if ($last !== 0 && $number-$last != 1) {
                $state = false;
                break;
            }
            $last = $number;
        }
        return $state;
    }
    
    /**
     * ペアを数え上げる
     */
    private function searchPair($cards) {
        $state = array();
        foreach ($cards as $card) {
            if (! isset($state[$card["number"]])) {
                $state[$card["number"]] = 0;
            }
            $state[$card["number"]]++;
        }
        return $state;
    }
}
