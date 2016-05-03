<?php

class TennisGame1 implements TennisGame
{
    private $m_score1 = 0;
    private $m_score2 = 0;
    private $player1Name = '';
    private $player2Name = '';

    public function __construct($player1Name, $player2Name)
    {
        $this->player1Name = $player1Name;
        $this->player2Name = $player2Name;
    }

    public function wonPoint($playerName)
    {
        if ($this->player1Name == $playerName) {
            $this->m_score1++;
        } else {
            $this->m_score2++;
        }
    }

    private function deuceScenario() {
        switch ($this->m_score1) {
            case 0:
                $score = "Love-All";
                break;
            case 1:
                $score = "Fifteen-All";
                break;
            case 2:
                $score = "Thirty-All";
                break;
            default:
                $score = "Deuce";
                break;
        }

        return $score;
    }

    private function winScenario() {
        $minusResult = $this->m_score1 - $this->m_score2;
        $result = abs($minusResult);
        $score = $this->advantage($minusResult);
        if ($this->winCondition($result)) {
            $score = $this->win($minusResult);
        }

        return $score;
    }

    private function advantage($minusResult){
        $test = ($this->advantageCondition($minusResult)) ? $this->player1Name : $this->player2Name;
        return 'Advantage ' . $test;
    }

    private function win($minusResult){
        $test = ($this->winCondition($minusResult)) ? $this->player1Name : $this->player2Name;
        return 'Win for ' . $test;
    }

    private function advantageCondition($result) {
        return $result == 1;
    }

    private function winCondition($result) {
        return $result >= 2;
    }

    private function pointScenario() {
        return $this->appendScore($this->m_score1) . '-' . $this->appendScore($this->m_score2);
    }

    private function appendScore($tempScore) {
        $score='';
        switch ($tempScore) {
            case 0:
                $score .= "Love";
                break;
            case 1:
                $score .= "Fifteen";
                break;
            case 2:
                $score .= "Thirty";
                break;
            default:
                $score .= "Forty";
                break;
        }
        return $score;
    }

    public function getScore()
    {
        if ($this->m_score1 == $this->m_score2) {
            $score = $this->deuceScenario();
        }
        elseif ($this->m_score1 >= 4 || $this->m_score2 >= 4) {
            $score = $this->winScenario();
        }
        else {
            $score = $this->pointScenario();
        }

        return $score;
    }
}

