<?php

class Secret extends Controller {
    public function index() {
        if (!isset($_SESSION['auth'])) {
        header("Location: /Login");
        exit;
    }
        $this->view('secret/index');
}
}