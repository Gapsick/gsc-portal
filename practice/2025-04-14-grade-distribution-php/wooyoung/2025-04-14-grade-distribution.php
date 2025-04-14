<?php
$score = [92 , 85 , 34 , 76, 58 , 90 , 61 , 70 , 45 , 99 , 82 , 67 , 50 , 77 , 89];

$a = [];
$b = [];
$c = [];
$d = [];
$f = [];

//등급 나누기 
foreach ($score as $s) {
    if ($s >= 90) {
        $a[] = $s;
    }else if ($s >= 80) {
        $b[] = $s;
    }else if ($s >= 70) {
        $c[] = $s;
    }else if ($s >= 60) {
        $d[] = $s;
    }else{
        $f[] = $s;
    }
}

//계산 출력함수 
function print_grapgh($array , $grade) {
    $sum = 0;
    $count = count($array);
    foreach ($array as $h) {
        $sum += $h;
    }
    $average = $sum / count($array);
    $average = round($average,2);
    echo "{$grade}등급: 평균점수 = {$average} " . str_repeat("*", $count) . " ({$count}명)\n";

}

//출력 
print_grapgh($a,"A");
print_grapgh($b,"B");
print_grapgh($c,"C");
print_grapgh($d,"D");
print_grapgh($f,"F");