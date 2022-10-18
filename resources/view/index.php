<?php
require_once "templates/header.php";
?>
<div id="registerform" class="<?= playersRegistered()? 'hidden' : '' ?>">
    <form method="post" action="/register">
        <div class="welcome">
            <h1>Start playing Tic Tac Toe!</h1>
            <h2>Please fill in your names</h2>

            <div class="p-name">
                <label for="player-x"> Player (First)</label>
                <input type="text" id="player-x" name="player-x" required />
            </div>

            <div class="p-name">
                <label for="player-o"> Player (Second)</label>
                <input type="text" id="player-o" name="player-o" required />
            </div>

            <button type="submit">Start</button>
        </div>
    </form>
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

                    <a href="/play?new=true">Play again</a><br />
                    <a href="/?new=true">Reset game</a><br />
                </div>
            </td>
        </tr>
    </table>
</div>
<?php
require_once "templates/footer.php";