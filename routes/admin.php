<?php
$act = $_GET['act'] ?? '/';
if(isset($_SESSION['user'])&& $_SESSION['user']['Role'] == '1'){
    match ($act) {
    // Trang chủ
    '/'=>(new ProductController())->Home(),
    'logout' =>(new LoginController())->logout(),

};

}else{
    header("Location: ". BASE_URL);
    exit;
}

?>