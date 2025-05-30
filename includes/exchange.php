<?php
function rielToUSD($riel) {
    $usd = $riel / 4000;
    return number_format($usd, 2, '.', '');
}

function logExchange($usd, $riel) {
    file_put_contents('Exchange.txt', "$usd USD\t\t$riel រៀល\n", FILE_APPEND);
}
