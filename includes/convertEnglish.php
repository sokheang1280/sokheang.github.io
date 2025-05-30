<?php
function numberToEnglishWords($n) {
    if ($n == 0) return 'Zero';
    $ones = [
        '', 'One', 'Two', 'Three', 'Four', 'Five', 'Six',
        'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve',
        'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen',
        'Eighteen', 'Nineteen'
    ];
    $tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
    $units = ['', 'Thousand', 'Million', 'Billion'];

    $w = [];
    $u = 0;
    while ($n) {
        $c = $n % 1000;
        if ($c) {
            $cw = [];
            $h = intdiv($c, 100);
            $r = $c % 100;
            if ($h) $cw[] = $ones[$h] . ' Hundred';
            if ($r < 20) {
                if ($r) $cw[] = $ones[$r];
            } else {
                $cw[] = $tens[intdiv($r, 10)];
                if ($r % 10) $cw[] = $ones[$r % 10];
            }
            if ($units[$u]) $cw[] = $units[$u];
            array_unshift($w, implode(' ', array_filter($cw)));
        }
        $n = intdiv($n, 1000);
        $u++;
    }
    return implode(' ', $w);
}
