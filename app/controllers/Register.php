<?php

class Register extends Controller {
    public function index() {
        $this->view('register/index');
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $plainPassword = trim($_POST['password'] ?? '');

            // ✅ Securely hash the password before storing
            $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

            $db = db_connect();

            // ✅ Prevent duplicate usernames (optional but useful)
            $stmt = $db->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetch()) {
                $_SESSION['flash'] = "Username already taken.";
                header("Location: /index.php?url=register");
                exit;
            }

            // ✅ Insert user
            $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hashedPassword]);

            $_SESSION['flash'] = "🎉 Registered successfully!";
            header("Location: /index.php?url=login");
            exit;
        }
    }
}
