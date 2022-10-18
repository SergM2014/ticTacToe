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
        $currentPlayer = $this->gameEngine->currentPlayer();
        $turnSign = $this->gameEngine->getTurn();
     
        echo json_encode(['playAgain' => true, 'player' => $currentPlayer, 'turnSign' => $turnSign ]);
    }

    public function reset(): void
    { 
        $this->gameEngine->resetGame();

        echo json_encode(['playersRegistered' => false ]);
    }

    public function register(): void
    {
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

        $player = $this->gameEngine->currentPlayer();
        $turnSign = $this->gameEngine->getTurn();

        if($win || $tie) {
            $this->gameEngine->resetBoard();
            
        }
        $scoreX = $this->gameEngine->score('x');
        $scoreO = $this->gameEngine->score('o');
        $playerX = $this->gameEngine->playerName('x');
        $playerO = $this->gameEngine->playerName('o');

        echo json_encode([
             'player' => $player,
             'turnSign' => $turnSign, 
             'win' => $win,
             'tie' => $tie,
             'scoreX' => $scoreX,
             'scoreO' => $scoreO,
             'playerX' => $playerX,
             'playerO' => $playerO,
        ]);
    }
    
}