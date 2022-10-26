<?php
require_once "templates/header.php";
?>
<register-form :show="showRegister" @register="register"></register-form>


<div v-show="showPlayBoard" >
<h2>
    
   <span  v-text="player"></span>'s turn, plays by
   <span  class="red" v-text="turnSign"></span>
 
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

           <td class="cell  <?= $additionalClass ?>" id="cell_<?= $i ?>" @click="turn(<?= $i ?>)">
             
           </td>

       <?php } ?>

       </tr>
       </tbody>
   </table>
</div>

<result-block :show="showResult" :result="result" @replay="replay" @reset="reset" ></result-block>

<?php
require_once "templates/footer.php";