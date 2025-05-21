const scores = [92, 85, 34, 76, 58, 90, 61, 70, 45, 99];
// 0번째 총합계
const result = {
    "우수" : [0],
    "양호" : [0],
    "보통" : [0],
    "미흡" : [0]
};

for (let i = 0; i < scores.length; i++){
    let key = "미흡"
    if (scores[i] >= 90){
        key = "우수";
    }else if(scores[i] >= 70){
        key = "양호";
    }else if(scores[i] >= 50){
        key = "보통";
    }
    // 추가 & 더하기
    result[key].push(scores[i]);
    result[key][0] += scores[i];
}

for(let nums in result){
    // 평균
    avg = result[nums][0] / (result[nums].length - 1);
    console.log(
        `${nums}: [${result[nums].slice(1)}] 평균: ${avg}`
    );
}