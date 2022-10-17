<?php

require_once "templates/header.php";

?>

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

<?php
require_once "templates/footer.php";