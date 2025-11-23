<?php
$act = $_GET['act'] ?? '/';
if(isset($_SESSION['user'])&& $_SESSION['user']['Role'] == '0'){
    match ($act) {
    // Trang chủ
    '/'=>(new HdvController())->HomeHdv(),
    'logout' =>(new LoginController())->logout(),
};

}else{
    header("Location: ". BASE_URL);
    exit;
}

?>