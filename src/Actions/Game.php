<?php

declare(strict_types=1);

namespace Src\Actions;

use Src\Interfaces\GameInterface;
use Src\Interfaces\AuthentificationInterface;
use Src\Interfaces\GameEngineInterface;
use Src\Interfaces\StorageInterface;

class Game extends Controller implements  GameInterface, AuthentificationInterface
{
    public function __construct(
        private GameEngineInterface $gameEngine,
        private StorageInterface $storage
    ) {}

    public function index(): mixed
    {
        

        if (!$this->playersRegistered()) {
            $this->start(); 
            return null;
        }
        $this->gameEngine->resetBoard();
     
        return view('index.php');
    }
    
    /**
     * start
     *
     * @return mixed
     */
    public function start(): mixed
    { 
        if(@$_GET['new'] != true){
            $this->storage->get();
            if ($this->playersRegistered()) {
                $this->play();
                return null;
            }
        }
        
        $this->gameEngine->resetGame();

        return view('start.php');
    }
    
    /**
     * register
     *
     * @return void
     */
    public function register(): void
    {
        if ($this->playersRegistered()) {
            $this->play(); 
            return;
        }

        $this->storage->get();

        if(isset($_POST['player-x']) && isset($_POST['player-o'])) {
            $this->gameEngine->initSettings('x');
        }

        $this->play(); 

        return;
    }
    
    /**
     * play
     *
     * @return mixed
     */
    public function play(): mixed
    {
        if(@!$_GET['new']) $this->storage->get();

        if (!$this->playersRegistered()) {
            $this->start(); 
            return null;
        }
        $this->gameEngine->resetBoard();
     
        return view('play.php');
    }
    
    /**
     * turn
     *
     * @return void
     */
    public function turn(): void
    {
        if (!isset($_POST['cell'])) return;
        
        $win = $this->gameEngine->play($_POST['cell']);
        $tie = $this->gameEngine->playsCount() >= 9 ? true : false;
        
        $this->storage->set();
        
        $player = currentPlayer();
        $turnSign = getTurn();
        
        $this->storage->set();

        echo json_encode(['player' => $player, 'turnSign' => $turnSign, 'win' => $win,'tie' => $tie ]);
    }
    
    /**
     * result
     *
     * @return mixed
     */
    public function result(): mixed
    {
        if (!$this->playersRegistered()) {
            $this->start(); 
            return null;
        }
      
        $this->gameEngine->resetBoard();
        
        return view('result.php');
    }
}