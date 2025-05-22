// 학생들의 점수 리스트
const scores = [92, 85, 34, 76, 58, 90, 61, 70, 45, 99];

// 점수를 4 가지 등급으로 분류하는 함수
function Verification(scoreList) {
  const result = {
    우수: [], // 90점 이상
    양호: [], // 70점 이상 ~ 90점 미만
    보통: [], // 50점 이상 ~ 70점 미만
    미흡: [], // 50점 미만
  };
  // 점수 리스트를 순회하면서 하나씩 분류
  for (let i = 0; i < scoreList.length; i++) {
    const score = scoreList[i]; // 현재 점수

    // 조건에 따라 해당 등급 배열에 추가가
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
  // 분류가 끝나면 결과 반환
  return result;
}

// 주어진 숫자 배열의 평균을 구하는 함수
function calculateAverage(arr) {
  let sum = 0; // 총합을 저장할 변수

  // 배열의 모든 값을 더함
  for (let i = 0; i < arr.length; i++) {
    sum += arr[i];
  }

  // 반환값 : 총합 / 개수수
  return sum / arr.length;
}

// 등급별 점수 리스트와 평균을 출력하는 함수
function prtResult(result) {
  // 객체의 모든 key(우수, 양호, 보통, 미흡)를 반복
  for (const key in result) {
    const list = result[key]; // 해당 등급의 점수 리스트
    const avg = calculateAverage(list); // 해당 등급의 평균 (함수 호출하여 반환값으로 평균값 받음)

    // 결과 출력
    console.log(`${key}: [${list}] 평균: ${avg}`);
  }
}

const result = Verification(scores); // 점수 분류 함수 호출
prtResult(result); // 분류 결과 함수 호출
