<?php

class Login extends Controller {
    public function index() {
        $this->view('login/index');
    }

    public function auth() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $db = db_connect();
            $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);


            

            // 🔍 Debugging (optional - can remove after confirming)
            // echo '<pre>'; var_dump($user); var_dump($password); exit;

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['auth'] = true;
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role'] ?? 'user'
                ];
                header("Location: /Home");
                exit;
            } else {
                $error = "Invalid credentials";
                $this->view('login/index', ['error' => $error]);
            }
        } else {
            header("Location: /index.php?url=login");
            exit;
        }
    }


}
