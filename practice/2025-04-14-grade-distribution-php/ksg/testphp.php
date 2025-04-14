<?php

// 학생들의 점수 데이터를 분석, 점수에 따른 등급 분포 텍스트 기반의 그래프로 시각화 프로그램
$score = [92, 85, 34, 76, 58, 90, 61, 70, 45, 99, 82, 67, 50, 77, 89];
$stdSum = [[0, 0], [0, 0], [0, 0], [0, 0], [0, 0]];
$stdGrade = ['A', 'B', 'C', 'D', 'F'];
$stdStar = ["", "", "", "", ""];
$gradeIndex = 0;

//학생 성적 판별 인덱스 0 -> 합계 성적, 1 -> 학생 수
for ($i = 0; $i < count($score); $i++){
    if ($score[$i] >= 90) {
        // A
        $gradeIndex = 0;
    } else if($score[$i] >= 80) {
        // B
        $gradeIndex = 1;
    } else if($score[$i] >= 70) {
        // C
        $gradeIndex = 2;
    } else if($score[$i] >= 60) {
        // D
        $gradeIndex = 3;
    } else {
        // F
        $gradeIndex = 4;
    }
    $stdSum[$gradeIndex][0] += $score[$i];
    $stdSum[$gradeIndex][1] += 1;
    $stdStar[$gradeIndex] .= '*';
}

// 점수 분류
//  - 90 ~    : A
//  - 80 ~ 89 : B
//  - 70 ~ 79 : C
//  - 60 ~ 69 : D
//  -    ~ 59 : F

// 각 등급 별 학생 계산 및 등급별 학생 수 "*" 문자로 히스토그램 형태로 시각화
echo "등급 분포 및 평균 점수:<br>";
for ($i = 0; $i < 5; $i++) {
    $avg = $stdSum[$i][0] / $stdSum[$i][1];
    // 소수점 ㅎㅎ 봐주세요
    echo "{$stdGrade[$i]} 등급: 평균 점수 = {$avg}<br>";
    echo "{$stdStar[$i]} ({$stdSum[$i][1]}명)<br>";
}
?>
