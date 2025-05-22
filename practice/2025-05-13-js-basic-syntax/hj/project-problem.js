// 학생들의 점수 리스트 등급 분류

// 학새들의 점수 리스트
let scores = [92, 85, 34, 76, 58, 90, 61, 70 ,45 ,99]

// 등급별로 점수 저장할 배열 초기화
let A = [], B = [], C = [], F = [];

// 점수 분류
scores.forEach(function(score) {
    if (score >= 90) {
        A.push(score);
    } else if (score >= 70) {
        B.push(score);
    } else if (score >= 50) {
        C.push(score);
    } else {
        F.push(score);
    }
});

// 평균 구하는 함수
function Average(arr) {
    if (arr.length === 0) return 0;
    let sum = 0;
    for (let i = 0; i < arr.length; i++) {
        sum += arr[i];
    }
    return sum / arr.length;
}

// 결과 출력
console.log("우수:", A, "평균:", Average(A));
console.log("양호:", B, "평균:", Average(B));
console.log("보통:", C, "평균:", Average(C));
console.log("미흡:", F, "평균:", Average(F));