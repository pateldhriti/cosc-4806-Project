<?php

class Logout extends Controller {
    public function index() {
        session_unset();
        session_destroy();

        // Optional: Start a new session to avoid warning later
        session_start();

        $_SESSION['flash'] = "✅ You have been logged out.";
        header("Location: /index.php?url=login");
        exit;
    }
}
