let input = document.querySelector(`.entered-list`); //입력창
let addBtn = document.querySelector(`.add-list`); //추가버튼
let tasks = document.querySelector(`.tasks`); // 할일 목록 전체 박스

//입력창에 아무것도 없으면 추가버튼 비활성화
input.addEventListener(`keyup`, () => {
    if (input.value.trim() !== "") {
        addBtn.classList.add(`active`);
    } else {
        addBtn.classList.remove(`active`);
    }
});


//할일 추가
addBtn.addEventListener(`click`, () => {
    if (input.value.trim() !== "") {
        let newItem = document.createElement(`div`);
        newItem.classList.add(`item`);
        newItem.innerHTML = `
            <p>${input.value}</p>
            <div class="item-btn">
                <i class="fa-solid fa-pen-to-square"></i>
                <i class="fa-solid fa-xmark"></i>
            </div>
        `
        tasks.prepend(newItem);
        input.value = ``; // 입력창 초기화
    } else {
        alert(`please enter a task`);
    }
});

//삭제
tasks.addEventListener(`click`, (e) => {
    if (e.target.classList.contains(`fa-xmark`)) {
        e.target.parentElement.parentElement.remove();
    }
});


tasks.addEventListener('click', (e) => {
    const item = e.target.closest('.item');
    if (!item) return;

    // 수정 버튼이 눌렸을 때
    if (e.target.classList.contains('fa-pen-to-square')) {
        const p = item.querySelector('p');
        const input = document.createElement('input');
        input.type = 'text';
        input.value = p.textContent;

        // 기존 p 숨기고 input 추가
        p.style.display = 'none';
        item.insertBefore(input, item.querySelector('.item-btn'));
        input.focus();

        // 아이콘을 저장 아이콘으로 변경 (선택 사항)
        e.target.classList.remove('fa-pen-to-square');
        e.target.classList.add('fa-floppy-disk');
    }

    // 저장 버튼이 눌렸을 때
    else if (e.target.classList.contains('fa-floppy-disk')) {
        const input = item.querySelector('input');
        const p = item.querySelector('p');

        if (input && input.value.trim() !== '') {
            p.textContent = input.value;
        }

        input.remove();
        p.style.display = 'block';

        // 아이콘을 다시 수정 아이콘으로 변경
        e.target.classList.remove('fa-floppy-disk');
        e.target.classList.add('fa-pen-to-square');
    }
});

