<?php

declare(strict_types=1);

namespace Src\Actions;

use Src\Interfaces\GameProcessInterface;
use Src\Interfaces\AuthentificationInterface;
use Src\Interfaces\GameEngineInterface;
use Src\Interfaces\StorageInterface;

class Game extends Controller implements  GameProcessInterface, AuthentificationInterface
{
    public function __construct(
        private GameEngineInterface $gameEngine,
        private StorageInterface $storage
    ) {}
    
    /**
     * index
     *
     * @return mixed
     */
    public function index(): mixed
    {
        return view('index.php');
    }

    /**
     * init
     *
     * @return void
     */
    public function init(): void
    {
        if(!$this->playersRegistered()) { 
            echo json_encode(['registered' => false]);
            return;
        }

        $playedCells = $this->gameEngine->getPlayedCells();

        extract($this->gameEngine->getMovePlayerAndTurn());

        echo json_encode([
            'registered' => true,
            'play' => true,
            'player' => $player,
            'turnSign' => $turnSign,
            'playedCells' => $playedCells
        ]);
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

        extract($this->gameEngine->getMovePlayerAndTurn());

        if($win || $tie) $this->gameEngine->resetBoard();
        
        extract($this->gameEngine->getMoveInfo());

        echo json_encode([
             'player' => $player,
             'turnSign' => $turnSign, 
             'win' => $win,
             'tie' => $tie,
             'scoreX' => $scoreX,
             'scoreO' => $scoreO,
             'playerX' => $playerX,
             'playerO' => $playerO,
             'count' => $count
        ]);
    }
    
    /**
     * reset
     *
     * @return void
     */
    public function reset(): void
    { 
        $this->gameEngine->resetGame();

        echo json_encode(['playersRegistered' => false ]);
    }
    
    /**
     * register
     *
     * @return void
     */
    public function register(): void
    {
        if(isset($_POST['playerX']) && isset($_POST['playerO'])) { 
            $this->gameEngine->initSettings('x');
            $this->turn(); 
        }

        return;
    }  
}