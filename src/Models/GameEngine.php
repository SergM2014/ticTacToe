<?php

declare(strict_types=1);

namespace Src\Models;

use Src\Interfaces\GameEngineInterface;

class GameEngine implements GameEngineInterface
{    
    /**
     * initSettings
     *
     * @param  mixed $sign
     * @return void
     */
    public function initSettings($sign): void
    {
        $this->setPlayers();
        $this->setTurn($sign);
        $this->resetBoard();
        $this->resetWins();
    }
    
    private function setTurn(string $turn = 'x'): void
    {
        $_SESSION['TURN'] = $turn;
    }
    
    /**
     * resetBoard
     *
     * @return void
     */
    public function resetBoard(): void
    {
       $this->resetPlaysCount();

        for ( $i = 1; $i <= 9; $i++ ) {
            unset($_SESSION['CELL_' . $i]);
        }
    }
    
    /**
     * resetPlaysCount
     *
     * @return void
     */
    private function resetPlaysCount(): void
    {
        $_SESSION['PLAYS'] = 0;
    }
    
    /**
     * resetWins
     *
     * @return void
     */
    private function resetWins(): void
    {
        $_SESSION['PLAYER_X_WINS'] = 0;
        $_SESSION['PLAYER_O_WINS'] = 0;
    }
    
    /**
     * setPlayers
     *
     * @return void
     */
    private function setPlayers(): void
    {
        $_SESSION['PLAYER_X_NAME'] = $_POST['playerX'] ?? "";
        $_SESSION['PLAYER_O_NAME'] = $_POST['playerO'] ?? "";
    }
    
    /**
     * play
     *
     * @param  mixed $cell
     * @return bool
     */
    public function play($cell=''): bool
    {
        if ($this->getCell($cell)) {
            return false;
        }
    
        $_SESSION['CELL_' . $cell] = $this->getTurn();

        $this->addPlaysCount();
        $win = $this->checkIfPlayWin($cell);

        if (!$win) {
            $this->switchTurn();
        }
        else {
            $this->markWin($this->getTurn());
            $this->resetBoard();
        }
    
        return $win;
    }
    
    /**
     * getCell
     *
     * @param  mixed $cell
     * @return string
     */
    private function getCell($cell=''): ?string
    {
        return @$_SESSION['CELL_' . $cell];
    }
    
    /**
     * getTurn
     *
     * @return string
     */
    public function getTurn(): string
    {
        return $_SESSION['TURN'] ??= 'x';
    }
    
    /**
     * playsCount
     *
     * @return int
     */
    public function playsCount(): int
    {
        return $_SESSION['PLAYS'] ??= 0;
    }
    
    /**
     * addPlaysCount
     *
     * @return void
     */
    private function addPlaysCount(): void
    {
        if (! $_SESSION['PLAYS']) {
            $_SESSION['PLAYS'] = 0;
        }
    
        $_SESSION['PLAYS']++;
    }
    
    /**
     * checkIfPlayWin
     *
     * @param  mixed $cell
     * @return bool
     */
    private function checkIfPlayWin($cell=1): bool
    {
        if ($this->playsCount() < 3) return false;

        $player = $this->getTurn();
   
        return $this->isVerticalWin($player) 
                || $this->isHorizontalWin($player) 
                || $this->isDiagonalWin($player);
    }
     
    /**
     * isVerticalWin
     *
     * @param  mixed $column
     * @param  mixed $turn
     * @return bool
     */
    private function isVerticalWin(string $turn ='x'): bool 
    {
        for($i=1; $i <=3; $i++) {
            $win = $this->getCell($i) == $turn &&
            $this->getCell($i + 3) == $turn &&
            $this->getCell($i + 6) == $turn;
            if ($win == true) return true;
        }

        return false;
    }
    
    private function isHorizontalWin(string $turn='x'): bool 
    {
        for($i=1; $i<=7; $i = $i+3){
            $win = $this->getCell($i) == $turn &&
            $this->getCell($i + 1) == $turn &&
            $this->getCell($i + 2) == $turn;
            if ($win == true) return true;
        }
        return false;
    }
    
    /**
     * isDiagonalWin
     *
     * @param  mixed $turn
     * @return bool
     */
    private function isDiagonalWin(string $turn='x'): bool
    {
        $win = $this->getCell(1) == $turn &&
        $this->getCell(9) == $turn;
    
        if (! $win) {
            $win = $this->getCell(3) == $turn &&
            $this->getCell(7) == $turn;
        }
    
        return $win && $this->getCell(5) == $turn;
           
    }
    
    /**
     * switchTurn
     *
     * @return void
     */
    private function switchTurn(): void
    {
        switch ($this->getTurn()) {
            case 'x':
                $this->setTurn('o');
                break;
            default:
                $this->setTurn('x');
                break;
        }
    }
    
    /**
     * markWin
     *
     * @param  mixed $player
     * @return void
     */
    private function markWin(string $player='x'): void
    {
        $_SESSION['PLAYER_' . strtoupper($player) . '_WINS']++;
    }
    
    /**
     * resetGame
     *
     * @return void
     */
    public function resetGame(): void
    {
        session_unset();
        setcookie('game', "", time()-1, "/");
    }
    
       
    /**
     * currentPlayer
     *
     * @return string
     */
    public function currentPlayer(): string
    {
        return $this->playerName($this->getTurn());
    }
       
    /**
     * playerName
     *
     * @param  mixed $player
     * @return string
     */
    private function playerName($player='x'): string
    {
        return $_SESSION['PLAYER_' . strtoupper($player) . '_NAME'];

    }
         
    /**
     * score
     *
     * @param  mixed $player
     * @return int
     */
    private function score($player='x'): int
    {
        $score = $_SESSION['PLAYER_' . strtoupper($player) . '_WINS'];
        return $score ? $score : 0;
    }
         
    /**
     * getMarkedCells
     *
     * @return array
     */
    public function getPlayedCells(): array
    {
        $arr = [];
        for($i = 1; $i<10; $i++) {
            $arr[$i] = @$this->getCell($i);
        }

        return $arr;
    }
    
    /**
     * getMoveInfo
     *
     * @return array
     */
    public function getMoveInfo(): array
    {
        $scoreX = $this->score('x');
        $scoreO = $this->score('o');
        $playerX = $this->playerName('x');
        $playerO = $this->playerName('o');
        $count = $this->playsCount();

        return compact(['scoreX', 'scoreO', 'playerX', 'playerO', 'count']);
    }
            
    /**
     * getBoardEnviroment
     *
     * @return array
     */
    public function getBoardEnviroment(): array
    {
        $player = $this->currentPlayer();
        $turnSign = $this->getTurn();

        return compact(['player', 'turnSign']);
    }
}