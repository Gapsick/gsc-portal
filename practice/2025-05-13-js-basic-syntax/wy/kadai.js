function classify(score) {
  switch (true) {
    case score >= 90:
      return "우수";
    case score >= 70:
      return "양호";
    case score >= 50:
      return "보통";
    default:
      return "미흡";
  }
}

function average(arr) {
  let sum = 0;
  for (const value of arr) {
    sum += value;
  }
  const avg = sum / arr.length;
  return avg;
}

let scores = [92, 85, 34, 58, 90, 61, 70, 45, 99];

const categorizedScores = {
  "우수": [],
  "양호": [],
  "보통": [],
  "미흡": []
};

for (const score of scores) {
  const category = classify(score);
  categorizedScores[category].push(score);
}


for (const category in categorizedScores) {
  const list = categorizedScores[category];
  const avg = average(list);
console.log(`${category}: [${list}] 평균: ${avg.toFixed(2)}`);
}
