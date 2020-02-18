<?php
// Staring straight up into the sky ... oh my my
error_reporting(-1);
mb_internal_encoding('utf-8');


/* Возвращает соответствующую числу форму слова: 1 рубль, 2 рубля, 5 рублей */
function getWordForm($number, $word1, $word2, $word5) {
    if ($number % 10 == 1) {
        return $word1;
    }
    elseif ($number % 10 >= 2 && $number % 10 <=4) {
        return $word2;
    }
    else {
        return $word5;
    }
}

/*
    Преобразует числа от 0 до 999 в текст. Параметр $isFemale равен нулю,
    если мы считаем число для мужского рода (один рубль),
    и 1 — для женского (одна тысяча)
*/
function spellSmallNumber($number, $isFemale) {

    $spelling = array(
        0   =>  'ноль',                                     10  =>  'десять',       100 =>  'сто',
        1   =>  'один',         11  =>  'одиннадцать',      20  =>  'двадцать',     200 =>  'двести',
        2   =>  'два',          12  =>  'двенадцать',       30  =>  'тридцать',     300 =>  'триста',
        3   =>  'три',          13  =>  'тринадцать',       40  =>  'сорок',        400 =>  'четыреста',
        4   =>  'четыре',       14  =>  'четырнадцать',     50  =>  'пятьдесят',    500 =>  'пятьсот',
        5   =>  'пять',         15  =>  'пятнадцать',       60  =>  'шестьдесят',   600 =>  'шестьсот',
        6   =>  'шесть',        16  =>  'шестнадцать',      70  =>  'семьдесят',    700 =>  'семьсот',
        7   =>  'семь',         17  =>  'семнадцать',       80  =>  'восемьдесят',   800 =>  'восемьсот',
        8   =>  'восемь',       18  =>  'восемнадцать',     90  =>  'девяносто',     900 =>  'девятьсот',
        9   =>  'девять',       19  =>  'девятнадцать'
    );

    $femaleSpelling = array(
        1   =>  'одна',        2   =>  'две'
    );

    $resStr = '';
    $numberStr = "$number";

    if ($isFemale == 1) {
        $numberArr = preg_split("//", $numberStr, -1, PREG_SPLIT_NO_EMPTY);
        if (count($numberArr) == 3) {
            $resStr .= $spelling[$numberArr[0] * 100] . ' ';
            if ($numberArr[1] + $numberArr[2] != 0){
                if ($numberArr[1] == '1') {
                    $resStr .= $spelling[$numberArr[1] * 10 + $numberArr[2]] . ' ';
                }
                elseif ($numberArr[2] == '0') {
                    $resStr .= $spelling[$numberArr[1] * 10] . ' ';
                }
                elseif ($numberArr[1] == '0') {
                    if ($numberArr[2] == '1' || $numberArr[2] == '2') {
                        $resStr .= $femaleSpelling[$numberArr[2]] . ' ';
                    }
                    else {
                        $resStr .= $spelling[$numberArr[2]] . ' ';
                    }
                }
                else {
                    $resStr .= $spelling[$numberArr[1] * 10] . ' ';
                    if ($numberArr[2] == '1' || $numberArr[2] == '2') {
                        $resStr .= $femaleSpelling[$numberArr[2]] . ' ';
                    }
                    else {
                        $resStr .= $spelling[$numberArr[2]] . ' ';
                    }
                }
            }
        }
        elseif (count($numberArr) == 2) {
            if ($numberArr[0] == '1') {
                $resStr .= $spelling[$numberArr[0] * 10 + $numberArr[1]] . ' ';
            }
            elseif ($numberArr[1] == '0') {
                $resStr .= $spelling[$numberArr[0] * 10] . ' ';
            }
            else {
                $resStr .= $spelling[$numberArr[0] * 10] . ' ';
                if ($numberArr[1] == '1' || $numberArr[1] == '2') {
                    $resStr .= $femaleSpelling[$numberArr[1]] . ' ';
                }
                else {
                    $resStr .= $spelling[$numberArr[1]] . ' ';
                }
            }
        }
        elseif (count($numberArr) == 1) {
            if ($numberArr[0] == '1' || $numberArr[0] == '2') {
                $resStr .= $femaleSpelling[$numberArr[0]] . ' ';
            }
            else {
                $resStr .= $spelling[$numberArr[0]] . ' ';
            }
        }
        else {
            return $resStr;
        }
    }
    else {
        $numberArr = preg_split("//", $numberStr, -1, PREG_SPLIT_NO_EMPTY);
        if (count($numberArr) == 3) {
            $resStr .= $spelling[$numberArr[0] * 100] . ' ';
            if ($numberArr[1] + $numberArr[2] != 0){
                if ($numberArr[1] == '1') {
                    $resStr .= $spelling[$numberArr[1] * 10 + $numberArr[2]] . ' ';
                }
                elseif ($numberArr[2] == '0') {
                    $resStr .= $spelling[$numberArr[1] * 10] . ' ';
                }
                elseif ($numberArr[1] == '0') {
                    $resStr .= $spelling[$numberArr[2]] . ' ';
                }
                else {
                    $resStr .= $spelling[$numberArr[1] * 10] . ' ';
                    $resStr .= $spelling[$numberArr[2]] . ' ';
                }
            }
        }
        elseif (count($numberArr) == 2) {
            if ($numberArr[0] == '1') {
                $resStr .= $spelling[$numberArr[0] * 10 + $numberArr[1]] . ' ';
            }
            elseif ($numberArr[1] == '0') {
                $resStr .= $spelling[$numberArr[0] * 10] . ' ';
            }
            else {
                $resStr .= $spelling[$numberArr[0] * 10] . ' ';
                $resStr .= $spelling[$numberArr[1]] . ' ';
            }
        }
        elseif (count($numberArr) == 1) {
            $resStr .= $spelling[$numberArr[0]] . ' ';
        }
        else {
            return $resStr;
        }
    }
    return $resStr;
}

function spellNumber($number) {

    $endResArr = [];

    for ($i = 1;$number > 0; $i++){
        $bufStr = '';
        $bufNum = $number % 1000;
        if ($i == 1) {
            $bufStr .= spellSmallNumber($bufNum, 0);
            if ($bufNum % 100 >= 11 && $bufNum % 100 <= 19) {
                $bufStr .= "($number) рублей ";
                $endResArr[] = $bufStr;
            }
            else {
                $bufStr .= "($number) " . getWordForm($bufNum, 'рубль', 'рубля', 'рублей') . ' ';
                $endResArr[] = $bufStr;
            }
        }
        elseif ($i == 2) {
            $bufStr .= spellSmallNumber($bufNum, 1);
            if ($bufNum % 100 >= 11 && $bufNum % 100 <= 19) {
                $bufStr .= 'тысяч ';
                $endResArr[] = $bufStr;
            }
            else {
                $bufStr .= getWordForm($bufNum, 'тысяча', 'тысячи', 'тысяч') . ' ';
                $endResArr[] = $bufStr;
            }
        }
        elseif ($i == 3) {
            $bufStr .= spellSmallNumber($bufNum, 0);
            if ($bufNum % 100 >= 11 && $bufNum % 100 <= 19) {
                $bufStr .= 'миллионов ';
                $endResArr[] = $bufStr;
            }
            else {
                $bufStr .= getWordForm($bufNum, 'миллион', 'миллиона', 'миллионов') . ' ';
                $endResArr[] = $bufStr;
            }
        }
        $number = intdiv($number, 1000);
    }
    return $endResArr;
}

if (isset($_POST['money'])) {
    $answerArr = spellNumber($_POST['money']);
    $answerStr = '';
    for ($i = count($answerArr) - 1; $i >= 0; $i--) {
        $answerStr .= $answerArr[$i];
    }
    $result = array(
        'money' => $answerStr
    );

    echo json_encode($result);
}
