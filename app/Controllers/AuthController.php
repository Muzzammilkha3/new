<?php
class AuthController extends Controller
{
    public function showLogin(): void
    {
        $this->view('auth/login');
    }

    public function login(): void
    {
        $userModel = new User();
        $user = $userModel->findByEmail($_POST['email']);
        if ($user && password_verify($_POST['password'], $user['password'])) {
            Auth::login($user);
            $this->redirect('/?route=dashboard');
            return;
        }
        $this->view('auth/login', ['error' => 'Invalid credentials']);
    }

    public function logout(): void
    {
        Auth::logout();
        $this->redirect('/?route=login');
    }
}
