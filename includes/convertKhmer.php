<?php
function numberToKhmerWords($number) {
    $khmerNumbers = ['', 'មួយ', 'ពីរ', 'បី', 'បួន', 'ប្រាំ', 'ប្រាំមួយ', 'ប្រាំពីរ', 'ប្រាំបី', 'ប្រាំបួន'];
    $khmerTens = [
        10 => 'ដប់', 20 => 'ម្ភៃ', 30 => 'សាមសិប', 40 => 'សែសិប',
        50 => 'ហាសិប', 60 => 'ហុកសិប', 70 => 'ចិតសិប',
        80 => 'ប៉ែតសិប', 90 => 'កៅសិប'
    ];
    $units = [1000000 => 'លាន', 100000 => 'សែន', 10000 => 'ម៉ឺន', 1000 => 'ពាន់', 100 => 'រយ'];

    if ($number == 0) return 'សូន្យ';
    $out = '';
    foreach ($units as $v => $w) {
        if ($number >= $v) {
            $u = floor($number / $v);
            $number %= $v;
            $out .= numberToKhmerWords($u) . $w;
        }
    }
    if ($number >= 10) {
        if (isset($khmerTens[$number])) {
            $out .= $khmerTens[$number];
        } else {
            $t = floor($number / 10) * 10;
            $o = $number % 10;
            $out .= $khmerTens[$t] . $khmerNumbers[$o];
        }
    } elseif ($number > 0) {
        $out .= $khmerNumbers[$number];
    }
    return $out;
}
