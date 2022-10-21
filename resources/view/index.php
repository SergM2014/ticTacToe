<?php
require_once "templates/header.php";
?>

<div v-show="showRegister" id="registerForm" class="">
   
        <div class="welcome">
            <h1>Start playing Tic Tac Toe!</h1>
            <h2>Please fill in your names</h2>

            <div class="p-name">
                <label for="playerX"> Player (First)</label>
                <input type="text" id="playerX" name="playerX" required v-model="playerX"/>
            </div>

            <div class="p-name">
                <label for="playerO"> Player (Second)</label>
                <input type="text" id="playerO" name="playerO" required v-model="playerO" />
            </div>

            <button @click="register" id="registerButton">Start</button>
        </div>
    
</div>

<div v-show="showPlayBoard" id="playBoard" class="" >
<h2>
    
    <span id="player" v-text="player"></span>'s turn, plays by
   <span id="turnSign" class="red" v-text="turnSign"></span>
 
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

           <td class="cell  <?= $additionalClass ?>"data-id="<?= $i ?>" @click="turn">
             
           </td>

       <?php } ?>

       </tr>
       </tbody>
   </table>
</div>

<div v-show="showResult" id="resultBlock" class="">
    <table class="wrapper" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <div class="welcome">

                    <h1 id="outputWinner" class="hidden"> <span v-text="winner"></span> won!</h1>
                    <h1 id="outputTie" class="hidden">It's a tie!</h1>

                    <div  class="player-name">
                         <span v-text="playerXresult"></span>'s score: <b><span v-text="scoreX"></span></b>
                    </div>

                    <div class="player-name">
                         <span v-text="playerOresult"></span>'s score: <b><span v-text="scoreO"></span></b>
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