<?php
require_once 'includes/convertKhmer.php';
require_once 'includes/convertEnglish.php';
require_once 'includes/exchange.php';

$show = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['number']) && is_numeric($_POST['number'])) {
    $num = (int)$_POST['number'];
    $kh = numberToKhmerWords($num) . ' រៀល';
    $en = numberToEnglishWords($num) . ' Riel';
    $usd = rielToUSD($num);
    logExchange($usd, $num);
    $show = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Number → Khmer/English Converter</title>
    <link rel="stylesheet" href="assets/style.css">
    <script>function validateInput(e){e.value=e.value.replace(/[^0-9]/g,'');}</script>
</head>

<script>
function validateInput(e) {
    e.value = e.value.replace(/[^0-9]/g, '');
}

function clearForm() {
    document.getElementById('numberInput').value = '';
    const output = document.querySelector('.output');
    if (output) output.innerHTML = '';
    window.location.href = window.location.pathname; // Reload to clear results
}
</script>


<body>
    <h1>Convert Number to Khmer & English</h1>
    <form method="POST">
        <form method="POST" id="convertForm">
    <input type="text" name="number" id="numberInput" placeholder="Enter a number..." oninput="validateInput(this)" required>
    <button type="submit">Convert</button>
    <button type="button" onclick="clearForm()">Clear</button>
</form>

    </form>

    <?php if ($show): ?>
    <div class="output">
        <div class="result a"><strong>a.</strong> <?= htmlspecialchars($en) ?></div>
        <div class="result b"><strong>b.</strong> <?= htmlspecialchars($kh) ?></div>
        <div class="result c"><strong>c.</strong> <?= $usd ?> USD</div>
    </div>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    <p style="color:red;margin-top:20px;">❌ Please enter a valid number.</p>
    <?php endif; ?>
</body>
</html>
