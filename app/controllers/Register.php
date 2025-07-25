<?php

class Register extends Controller {
    public function index() {
        $this->view('register/index');
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);

            $db = db_connect();
            $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $password]);

            header("Location: /index.php?url=login");
            exit;
        }
    }
}
