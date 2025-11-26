<?php
// THE KEY
$secret_key = "RABBYKHAN2025"; 

// 1. Prepare text (Allow A-Z and 0-9)
function prepareText($text) {
    // Keep Letters and Numbers only
    $text = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $text)); 
    
    // Note: In 6x6, we DO NOT need to replace J with I because we have enough room.
    
    $clean_text = "";
    for ($i = 0; $i < strlen($text); $i++) {
        $clean_text .= $text[$i];
        if ($i < strlen($text) - 1 && $text[$i] == $text[$i+1]) {
            $clean_text .= "X"; // Padding for duplicates
        }
    }
    if (strlen($clean_text) % 2 != 0) $clean_text .= "X"; // Make even length
    return $clean_text;
}

// 2. Generate the 6x6 Matrix (A-Z and 0-9)
function generateMatrix($key) {
    $alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; // 36 Characters
    $key = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $key));
    $matrix_string = "";
    
    // Add key first
    for($i=0; $i<strlen($key); $i++) {
        if(strpos($matrix_string, $key[$i]) === false) $matrix_string .= $key[$i];
    }
    // Add rest of alphabet/numbers
    for($i=0; $i<strlen($alphabet); $i++) {
        if(strpos($matrix_string, $alphabet[$i]) === false) $matrix_string .= $alphabet[$i];
    }
    return str_split($matrix_string, 6); // SPLIT INTO 6 (Not 5)
}

// 3. Find Position Helper (Updated for 6x6)
function findPos($char, $matrix) {
    for($r=0; $r<6; $r++) { // Loop 6 rows
        for($c=0; $c<6; $c++) { // Loop 6 cols
            if($matrix[$r][$c] == $char) return [$r, $c];
        }
    }
    return [0,0];
}

// 4. Main Encryption Function
function playfairEncrypt($plaintext, $key) {
    $matrix = generateMatrix($key);
    $text = prepareText($plaintext);
    $ciphertext = "";

    for ($i = 0; $i < strlen($text); $i += 2) {
        $a = $text[$i];
        $b = $text[$i+1];
        
        list($r1, $c1) = findPos($a, $matrix);
        list($r2, $c2) = findPos($b, $matrix);

        if ($r1 == $r2) { // Same Row
            $ciphertext .= $matrix[$r1][($c1 + 1) % 6]; // Modulo 6
            $ciphertext .= $matrix[$r2][($c2 + 1) % 6]; // Modulo 6
        } elseif ($c1 == $c2) { // Same Col
            $ciphertext .= $matrix[($r1 + 1) % 6][$c1]; // Modulo 6
            $ciphertext .= $matrix[($r2 + 1) % 6][$c2]; // Modulo 6
        } else { // Rectangle
            $ciphertext .= $matrix[$r1][$c2];
            $ciphertext .= $matrix[$r2][$c1];
        }
    }
    return $ciphertext;
}
?>