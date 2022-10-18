<?php
require_once "templates/header.php";

?>
<div id="registerForm" class="<?= playersRegistered()? 'hidden' : '' ?>">
   
        <div class="welcome">
            <h1>Start playing Tic Tac Toe!</h1>
            <h2>Please fill in your names</h2>

            <div class="p-name">
                <label for="playerX"> Player (First)</label>
                <input type="text" id="playerX" name="playerX" required />
            </div>

            <div class="p-name">
                <label for="playerO"> Player (Second)</label>
                <input type="text" id="playerO" name="playerO" required />
            </div>

            <button id="registerButton">Start</button>
        </div>
    
</div>

<div id="playBoard" class="<?= playersRegistered()? '' : 'hidden' ?>" >
<h2>
    
    <span id="player"><?= currentPlayer() ?></span>'s turn, plays by
   <span id="turnSign" class="red"><?= getTurn() ?></span>
 
</h2>

   <table class="tic-tac-toe" cellpadding="0" cellspacing="0">
       <tbody>

       <?php
       $lastRow = 0;
       for ($i = 1; $i <= 9; $i++) {
           $row = ceil($i / 3);

           if ($row !== $lastRow) {
               $lastRow = $row;

               if ($i > 1) {
                   echo "</tr>";
               }

               echo "<tr class='row-{$row}'>";
           }

           $additionalClass = '';

           if ($i == 2 || $i == 8) {
               $additionalClass = 'vertical-border';
           }
           else if ($i == 4 || $i == 6) {
               $additionalClass = 'horizontal-border';
           }
           else if ($i == 5) {
               $additionalClass = 'center-border';
           }
           ?>

           <td class="cell cell-<?= $i ?> <?= $additionalClass ?>"data-id="<?= $i ?>">
               <?php if (@getCell($i) === 'x'): ?>
                   
                        <img src="/images/cross.png" class="smallImg" />
                  
               <?php elseif (@getCell($i) === 'o'): ?>
                  
                       <img src="/images/circle.png" class="smallImg" />
                  
               <?php endif; ?>
           </td>

       <?php } ?>

       </tr>
       </tbody>
   </table>
</div>

<!-- <div id="result" class="<?= playersRegistered()? '' : 'hidden' ?>"> -->
<div id="resultBlock" class="hidden">
    <table class="wrapper" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <div class="welcome">

                    <h1>
                        <?php
                        if (@$_GET['player']) {
                            echo currentPlayer() . " won!";
                        }
                        else {
                            echo "It's a tie!";
                        }
                        ?>
                    </h1>

                    <div class="player-name">
                        <?php echo playerName('x')?>'s score: <b><?php echo score('x')?></b>
                    </div>

                    <div class="player-name">
                        <?php echo playerName('o')?>' score: <b><?php echo score('o')?></b>
                    </div>

                    <button type="button" id="playAgain" class="playAgain">Play again</button>
                    <button type="button" id="resetGame" class="resetGame">Reset Game</button>

                </div>
            </td>
        </tr>
    </table>
</div>
<?php
require_once "templates/footer.php";