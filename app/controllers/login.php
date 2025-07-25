<?php

class Login extends Controller {
    public function index() {
        $this->view('login/index');
      
    }
  public function auth()
  {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $username = $_POST['username'] ?? '';
          $password = $_POST['password'] ?? '';

          if ($username === 'admin' && $password === 'password') {
              $_SESSION['auth'] = true;
              header("Location: /Home");
          } else {
              $error = "Invalid credentials";
              $this->view('login/index', ['error' => $error]);
          }
        }
     }
        }