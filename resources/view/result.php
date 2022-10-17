<?php
require_once "templates/header.php";

?>

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

</body>
</html>