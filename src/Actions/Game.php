<?php

declare(strict_types=1);

namespace Src\Actions;

use Src\Interfaces\GameInterface;
use Src\Interfaces\AuthentificationInterface;
use Src\Interfaces\GameEngineInterface;
use Src\Interfaces\StorageInterface;

class Game extends Controller //implements  GameInterface, AuthentificationInterface
{
    public function __construct(
        private GameEngineInterface $gameEngine,
        private StorageInterface $storage
    ) {}

    public function index(): mixed
    {
        return view('index.php');
    }

    public function play(): void
    {
        $this->storage->get();

        if (!$this->playersRegistered()) {
            echo json_encode(['playersRegistered' => false ]); 
            return ;
        }
        $this->gameEngine->resetBoard();
     
        echo json_encode(['playAgain' => true ]);
    }

    public function reset(): void
    { 
       // if(@$_POST['new'] != true){
            // $this->storage->get();
            // if ($this->playersRegistered()) {
            //     $this->playAgain();
            //     return;
            // }
       // }
       if (!$this->playersRegistered()) {
        echo json_encode(['playersRegistered' => false ]); 
        return ;
    }
        
        $this->gameEngine->resetGame();

        echo json_encode(['playAgain' => true ]);
    }

    public function register(): void
    {
        if ($this->playersRegistered()) {
            $this->play(); 
            return;
        }

        if(isset($_POST['playerX']) && isset($_POST['playerO'])) {
            $this->gameEngine->initSettings('x');
        }

        $this->play(); 

        return;
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
    
    // /**
    //  * result
    //  *
    //  * @return mixed
    //  */
    // public function result(): mixed
    // {
    //     if (!$this->playersRegistered()) {
    //         $this->start(); 
    //         return null;
    //     }
      
    //     $this->gameEngine->resetBoard();
        
    //     return view('result.php');
    // }
}