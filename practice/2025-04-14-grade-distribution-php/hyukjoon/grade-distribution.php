<?php
// 점수 배열
$scores = [92, 85, 34, 76, 58, 90, 61, 70, 45, 99, 82, 67,50, 77, 89]; 

// 등급별 카운트와 총합을 저장할 배열
$grade_counts = ["A" => 0, "B" => 0, "C" => 0, "D" => 0, "F" => 0];
$grade_sums = ["A" => 0, "B" => 0, "C" => 0, "D" => 0, "F" => 0];

// 점수 분석: 등급별 합계와 개수 계산
foreach ($scores as $score) {
    if ($score >=90) {
        $grade = "A";
    } elseif ($score >= 80) {
        $grade = "B";
    } elseif ($score >= 70) {
        $grade = "C";
    } elseif ($score >= 60) {
        $grade = "D";
    } else {
        $grade = "F";
    }
    // 각 등급별로 개수와 합계 누적
    $grade_counts[$grade]++;
    $grade_sums[$grade] += $score;
}
// 결과 출력
echo "등급 분포 및 평균 점수:\n";

foreach (["A","B","C","D","F"] as $grade) {
    $count = $grade_counts[$grade];
    $sum = $grade_sums[$grade];

    if ($count > 0){
        $avg = $sum / $count;
        echo "{$grade} 등급: 평균 점수 = " . number_format($avg,2) . "\n";
        } else {
            echo "{$grade} 등급: 평균 점수 = 없음\n";
        }
    
        echo str_repeat("*", $count) . "({$count}명)\n";
}
?>