<?php
require_once "templates/header.php";
?>
<register-form :show="showRegister" @register="register"></register-form>

<play-board :show="showPlayBoard" :turn-sign="turnSign" :player="player" :cells="cells" @turn="turn"></play-board>

<result-block :show="showResult" :result="result" @replay="replay" @reset="reset" ></result-block>

<?php
require_once "templates/footer.php";