<?php

class Login extends Controller {
    public function index() {
        $this->view('login/index');
    }

    public function auth() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            // Example credentials check (replace with DB lookup later)
            if ($username === 'admin' && $password === 'password') {
                $_SESSION['auth'] = true;
                $_SESSION['user'] = [
                    'id' => 1,
                    'username' => $username
                ];
                header("Location: /Home");
                exit;
            } else {
                $error = "Invalid credentials";
                $this->view('login/index', ['error' => $error]);
            }
        } else {
            // If accessed directly via GET
            header("Location: /index.php?url=login");
            exit;
        }
    }
}
