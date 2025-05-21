/**
 * 학생들의 점수 리스트가 주어졌을 때, 각 점수를 분류 분류된 점수들의 평균 계산
 * 
 * - 다음과 같이 점수 분류
 *  90이상 '우수'
 *  70이상 90미만 '양호'
 *  50이상 70미만 '보통'
 *  50미만 '미흡'
 */

// 학생들의 점수 리스트
const scores = [92, 85, 34, 76, 58, 90, 61, 70, 45, 99];

const total = {
    "우수" : [],
    "양호" : [],
    "보통" : [],
    "미흡" : []
};


for (let i = 0; i < scores.length; i++) {

    if (scores[i] >= 90) {
        total.우수.push(scores[i]);
    } else if (scores[i] >= 70) {
        total.양호.push(scores[i]);
    } else if (scores[i] >= 50) {
        total.보통.push(scores[i]);
    } else {
        total.미흡.push(scores[i]);
    }
}

for (let item in total) {
    let sum = 0;

    for (let i = 0; i < total[item].length; i++) {
        sum += total[item][i];
    }
    
    const avg = total[item].length ? sum / total[item].length : 0;

    console.log(`${item}: [${total[item]}] 평균: ${avg} `);
}
