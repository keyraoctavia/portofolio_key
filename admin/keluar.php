<?php
require_once __DIR__ . '/../includes/fungsi.php';
mulai_sesi();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_valid()) {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $c = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $c['path'], $c['domain'], $c['secure'], $c['httponly']);
    }
    session_destroy();
}
arahkan('admin/login.php');
