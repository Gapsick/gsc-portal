<?php
$scores = [92, 85, 34, 76, 58, 90, 61, 70, 45, 99, 82, 67, 50, 77, 89];
$allScore = [0, 0, 0, 0, 0];
$scoreLength = [0, 0, 0, 0, 0];
$grade = ["A", "B", "C", "D", "F"];

foreach($scores as $score) {
    if ($score >= 90) {
        $i = 0;
    }
    else if (80 <= $score && $score <= 90) {
        $i = 1;
    }
    else if (70 <= $score && $score <= 80) {
        $i = 2;
    }
    else if (60 <= $score && $score <= 70) {
        $i = 3;
    }
    else {
        $i = 4;
    }

    $allScore[$i] += $score;
    $scoreLength[$i] += 1;
}

// 출력
echo("등급 분포 및 평균 점수:");
for ( $i = 0; $i < 5 ; $i++ ) {
    echo("\n");
    echo($grade[$i]);
    echo(" 등급: 평균점수 = "); 
    echo(($allScore[$i] / $scoreLength[$i]));
    echo("\n");
    echo str_repeat("*", $scoreLength[$i]);
    echo(" (");
    echo($scoreLength[$i]);
    echo("명)");
}
?>