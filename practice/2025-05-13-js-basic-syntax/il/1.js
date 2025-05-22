// 학생들의 점수 리스트
const scores = [92, 85, 34, 76, 58, 90, 61, 70, 45, 99];

function Verification(scoreList) {
  const result = {
    우수: [],
    양호: [],
    보통: [],
    미흡: [],
  };
  for (let i = 0; i < scoreList.length; i++) {
    const score = scoreList[i];

    if (score >= 90) {
      result.우수.push(score);
    } else if (score >= 70) {
      result.양호.push(score);
    } else if (score >= 50) {
      result.보통.push(score);
    } else {
      result.미흡.push(score);
    }
  }
  return result;
}

function calculateAverage(arr) {
  let sum = 0;

  for (let i = 0; i < arr.length; i++) {
    sum += arr[i];
  }

  return sum / arr.length;
}

function prtResult(result) {
  for (const key in result) {
    const list = result[key];
    const avg = calculateAverage(list);

    console.log(`${key}: [${list}] 평균: ${avg}`);
  }
}

const result = Verification(scores);
prtResult(result);
