
// 요소 선택
const input = document.querySelector('#input-filed input');
const create_btn = document.querySelector('#input-filed button');
const list = document.querySelector('#item-list');

// // 버튼 클릭 시 동작
create_btn.addEventListener('click', () => {
    const text = input.value.trim();
    if (text === '') {
        alert('빈 값입니다.');
        return;
    }

    // li 요소 생성
    const item = document.createElement('li');
    
    // 체크박스 생성
    const checkbox = document.createElement('input');
    checkbox.type = 'checkbox';

    // 텍스트 span
    const span = document.createElement('div');
    span.innerText = text;

    // 수정 버튼
    const editBtn = document.createElement('button');
    editBtn.innerHTML = '수정';

    // 삭제 버튼
    const deleteBtn = document.createElement('button');
    deleteBtn.innerHTML = '삭제';

    // 체크박스 이벤트
    checkbox.addEventListener('change', () => {
        span.style.textDecoration = checkbox.checked ? 'line-through' : 'none';
    });

    // 수정 버튼 이벤트
    editBtn.addEventListener('click', () => {
        const newText = prompt('수정할 내용을 입력하세요', span.innerText);
        if (newText !== null && newText.trim() !== '') {
            span.innerText = newText.trim();
        }
    });

    // 삭제 버튼 이벤트
    deleteBtn.addEventListener('click', () => {
        item.remove();
    });

    // 요소 붙이기
    //item.textContent = text;
    item.appendChild(checkbox);
    item.appendChild(span);
    item.appendChild(editBtn);
    item.appendChild(deleteBtn);
    list.appendChild(item);

    // 입력창 초기화
    input.value = '';
});



