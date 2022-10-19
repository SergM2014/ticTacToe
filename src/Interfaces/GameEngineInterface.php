<?php

declare(strict_types=1);

namespace Src\Interfaces;

interface GameEngineInterface
{   
   /**
    * initSettings
    *
    * @param  mixed $sign
    * @return void
    */
   public function initSettings($sign): void;
   
   /**
    * play
    *
    * @return bool
    */
   public function play(): bool;
   
   /**
    * resetGame
    *
    * @return void
    */
   public function resetGame(): void;
   
   /**
    * getTurn
    *
    * @return string
    */
   public function getTurn(): string;
   
   /**
    * playsCount
    *
    * @return int
    */
   public function playsCount(): int;
   
   /**
    * resetBoard
    *
    * @return void
    */
   public function resetBoard(): void;
   
   /**
    * currentPlayer
    *
    * @return string
    */
   public function currentPlayer(): string;
   
      
   /**
    * playerName
    *
    * @param  mixed $player
    * @return string
    */
   public function playerName(string $player='x'): string;
   
      
   /**
    * score
    *
    * @param  mixed $player
    * @return int
    */
   public function score(string $player='x'): int;
   
   /**
    * getMarkedCells
    *
    * @return array
    */
   public function getMarkedCells(): array;
}