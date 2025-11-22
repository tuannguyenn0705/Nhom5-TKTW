<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #4F7DF3, #6BCDFE);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        padding: 20px;
    }

    .login-box {
        width: 350px;
        background: white;
        padding: 25px 20px;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(0,0,0,0.15);
    }

    .login-box h2 {
        text-align: center;
        margin-bottom: 25px;
        font-size: 24px;
        color: #222;
    }

    .login-box label {
        font-size: 14px;
        font-weight: 600;
        color: #444;
        display: block;
        margin-bottom: 6px;
    }

    .login-box input {
        width: 100%; /* FIX CHÍNH — không bao giờ tràn */
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        transition: 0.3s;
        margin-bottom: 18px;
        background: #fafafa;
    }

    .login-box input:focus {
        border-color: #007bff;
        background: white;
        box-shadow: 0 0 6px rgba(0,123,255,0.3);
    }

    .btn {
        width: 100%;
        padding: 12px;
        background: #007bff;
        border: none;
        border-radius: 8px;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn:hover {
        background: #0056b3;
    }
</style>


    </style>
</head>
<body>

<div class="login-box">
    <h2>Đăng nhập</h2>

    <form action="" method="POST">
        <label>Email</label>
        <input type="email" name="Email" placeholder="Nhập email" required>

        <label>Password</label>
        <input type="password" name="Password" placeholder="Nhập mật khẩu" required>

        <button type="submit" class="btn">Đăng nhập</button>
    </form>
</div>

</body>
</html>
