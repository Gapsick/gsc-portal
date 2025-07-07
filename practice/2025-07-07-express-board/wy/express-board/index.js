//  Node.js로 웹서버를 쉽게 만들 수 있게 도와주는 라이브러리
const express = require('express');

// Node.js에서 MySQL 데이터베이스랑 연결할 수 있게 해주는 모듈
const mysql = require('mysql2');

// 다른 도메인에서 접근해도 허용할 수 있도록 도와주는 모듈
const cors = require('cors');


// Express 앱 만들고 설정
const app = express();         //서버(앱)를 하나 만드는 코드
app.use(cors());                //서버에 CORS 기능을 켠다
app.use(express.json());        //요청(req.body)에 담긴 JSON 데이터를 읽을 수 있게 해주는 설정







// MySQL 연결 설정
const db = mysql.createConnection({
  host: '210.101.236.159',      // 이건 포트 포워딩 된 주소 (나중에 조정 가능)
  user: 'root',             // 너의 MySQL 계정
  password: 'gsc1234!@#$', // 너의 MySQL 비번
  database: 'wy_ex_board_db',     // 우리가 만들었던 게시판 데이터베이스 이름
});

// MySQL 연결 확인
db.connect((err) => {
  if (err) {
    console.error('DB 연결 실패:', err);
    return;
  }
  console.log('MySQL 연결 성공!');
});

// 서버 실행
app.listen(3000, () => {
  console.log('서버 실행 중: http://localhost:3000');
});


// 글 저장 API
app.post('/posts', (req, res) => {                         //클라이언트(Vue)가 /posts 주소로 POST 요청을 보냈을 때 req: 요청 정보 res: 응답 보내는 역할
  const { title, content, author } = req.body;

  if (!title || !content || !author) {
    return res.status(400).json({ message: '제목, 내용, 작성자는 필수입니다.' });
  }

  const sql = 'INSERT INTO posts (title, content, author) VALUES (?, ?, ?)';
  db.query(sql, [title, content, author], (err, result) => {
    if (err) {
      console.error('글 저장 중 오류:', err);
      return res.status(500).json({ message: 'DB 오류' });
    }

    res.status(201).json({ message: '글 저장 완료', postId: result.insertId });
  });
});


// 글 목록 보기 API                                     //GET 방식으로 /posts 주소로 요청이 오면 이 함수가 실행
app.get('/posts', (req, res) => {
  const sql = 'SELECT * FROM posts ORDER BY id DESC';
  db.query(sql, (err, results) => {
    if (err) {
      console.error('글 목록 조회 오류:', err);
      return res.status(500).json({ message: 'DB 오류' });
    }

    res.json(results); // author 포함된 전체 글 리스트 반환
  });
});


// 이건 반드시 Express 서버 쪽에만!
app.get('/posts/:id', (req, res) => {
  const { id } = req.params;

  const sql = 'SELECT * FROM posts WHERE id = ?';
  db.query(sql, [id], (err, results) => {
    if (err) {
      console.error('글 불러오기 실패:', err);
      return res.status(500).json({ message: 'DB 오류' });
    }

    if (results.length === 0) {
      return res.status(404).json({ message: '글을 찾을 수 없습니다.' });
    }

    res.json(results[0]);
  });
});


// 글 수정 API (PUT 요청 처리)
app.put('/posts/:id', (req, res) => {
  const { id } = req.params;
  const { title, content, author } = req.body;

  const sql = 'UPDATE posts SET title = ?, content = ?, author = ? WHERE id = ?';
  db.query(sql, [title, content, author, id], (err, result) => {
    if (err) {
      console.error('글 수정 실패:', err);
      return res.status(500).json({ message: 'DB 오류' });
    }

    res.json({ message: '글 수정 완료' });
  });
});


// 글 삭제 API (DELETE 요청 처리)
app.delete('/posts/:id', (req, res) => {
  const { id } = req.params;

  const sql = 'DELETE FROM posts WHERE id = ?';
  db.query(sql, [id], (err, result) => {
    if (err) {
      console.error('글 삭제 실패:', err);
      return res.status(500).json({ message: 'DB 오류' });
    }

    if (result.affectedRows === 0) {
      return res.status(404).json({ message: '글을 찾을 수 없습니다.' });
    }

    res.json({ message: '글 삭제 완료' });
  });
});
