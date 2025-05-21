const scores = [92, 85, 34, 76, 58, 90, 61, 70, 45, 99];

// 객체 선언
const res = {
    "우수": [],
    "양호": [],
    "보통": [],
    "미흡": []
};

// 점수 분류
for (let i = 0; i < scores.length; i++) {
    let check = scores[i];
    if (check >= 90) {
        res["우수"].push(check);
    } else if (check >= 70) {
        res["양호"].push(check);
    } else if (check >= 50) {
        res["보통"].push(check);
    } else {
        res["미흡"].push(check);
    }
}

// 평균 출력
for (let key in res) {

    // 배열 저장
    let arr = res[key];

    // 합계 변수 선언
    let sum = 0;

    // 배열 더하기
    for (let i = 0; i < arr.length; i++) {
        sum += arr[i];
    }

    // 평균 구하기
    let avg = arr.length > 0 ? (sum / arr.length) : 0;

    // 출력
    console.log(`${key}: [${arr}] 평균: ${avg}`);
}
