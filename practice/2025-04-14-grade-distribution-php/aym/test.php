<?php

// 학생 점수 리스트
$scores = [92, 85, 34, 76, 58, 90, 61, 70, 45, 99, 82, 67, 50, 77, 89];
$lebels = ["A", "B", "c", "d", "F"];

// 각 등급별 점수 저장 리스트 초기화
$grade = [[], [], [], [], []];

// 학생점수 하나씩 확인
for ($i = 0; $i < count($scores); $i++){

    // 반복할 때 마다 레벨의 최저 점을 내리기 -10 (90 -> 50)
    for ($j = 0, $levelMin = 90; $j < count($lebels); $j++, $levelMin -= 10){

        // 학생점수가 등급의 최저점수 이상 /  최저점수가 50이면 나머지 F처리
        if($scores[$i] >= $levelMin || $levelMin == 50){

            // 해당 등급의 배열에 추가
            $grade[$j][] = $scores[$i];

            // 추가하면 종료 -> 다음 학생
            break;
        }
    }
}

// 출력
echo("등급 분포 및 평균 점수:\n");
// 각 등급마다 반복해 출력
for ($i = 0; $i < count($lebels); $i++){
    // 등급별 학생 수
    $num = count($grade[$i]);

    echo "{$lebels[$i]} 등급: 평균 점수 = ";
    // 평균 : 합계(array_sum) / 원소의 수 
    echo array_sum($grade[$i]) / $num, "\n";
    // 학생 수 만큼 * 출력
    for($j = 0; $j < $num; $j++){
        echo "*";
    }
    echo "({$num}명)\n";
}
?>