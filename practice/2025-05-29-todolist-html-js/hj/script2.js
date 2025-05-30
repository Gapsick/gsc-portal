function addTodo() {
  const input = document.getElementById("todoInput"); 
  const newTodo = input.value.trim(); // 입력한 텍스트 -> input.value 로 가져옴 -> newTodo
  
  if (newTodo !== "") { // 입력값이 비어 있지 않을때
    const li = document.createElement("li"); // 태그 생성

    // 체크박스
    const checkbox = document.createElement("input"); // input type "체크박스" 생성
    checkbox.type = "checkbox"; // 체크박스 속성 지정

    // 텍스트 span
    const textSpan = document.createElement("span"); // span 태그 생성
    textSpan.textContent = " " + newTodo + " "; 

    // ✏ 수정 버튼
    const editBtn = document.createElement("button"); // 버튼 태그 생성
    editBtn.textContent = "✏";
    editBtn.onclick = function () { // 버튼 클릭시 함수 실행
      const editInput = document.createElement("input");
      editInput.type = "text";
      editInput.value = textSpan.textContent.trim();

      // 저장 함수: 엔터 또는 포커스 아웃 시
      function saveEdit() { // 수정 내용을 저장하는 함수
        const updated = editInput.value.trim(); 
        if (updated !== "") {
          textSpan.textContent = " " + updated + " ";
        }
        li.replaceChild(textSpan, editInput); // 기존 요소를 새 요소로 바꿈
      }

      // 엔터로 저장
      editInput.addEventListener("keydown", function (e) { // 이벤트 객체 
        if (e.key === "Enter") { // 엔터를 누를시 수정내용 세이브
          saveEdit(); 
        }
      });

      // 포커스 벗어나도 저장
      editInput.addEventListener("blur", saveEdit); // 벗어날시 블러처리

      li.replaceChild(editInput, textSpan);
      editInput.focus();
    };

    // ❌ 삭제 버튼
    const deleteBtn = document.createElement("button"); // 버튼 태그 생성
    deleteBtn.textContent = "❌";
    deleteBtn.onclick = function () { 
      li.remove();
    };

    // 조립
    li.appendChild(checkbox);
    li.appendChild(textSpan);
    li.appendChild(editBtn);
    li.appendChild(deleteBtn);

    document.getElementById("todoList").appendChild(li);
    input.value = "";
  }
}
