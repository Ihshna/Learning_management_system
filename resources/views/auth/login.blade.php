<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        /* Common Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", sans-serif;
        }

        body {
            background: #f5f7fa;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 850px;
            height: 500px;
            background: #fff;
            display: flex;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        }

        .left {
            width: 50%;
            background: #20c997;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .right {
            width: 50%;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px;
        }

        h2 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        p {
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border-radius: 25px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        button {
            background: #20c997;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-size: 14px;
            cursor: pointer;
            margin-top: 15px;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #17a589;
        }

        a {
            color: white;
            font-weight: 600;
            text-decoration: none;
            margin-top: 15px;
            border: 2px solid white;
            padding: 10px 25px;
            border-radius: 25px;
        }

        a:hover {
            background: white;
            color: #20c997;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left">
            <h2>Welcome Back!</h2>
            <p>To keep connected with us, please login with your personal info</p>
            <a href="{{ route('register') }}">SIGN UP</a>
        </div>
        <div class="right">
            <h2>Login to Your Account</h2>

            @if(session('error'))
        <div style="color: red; font-weight: bold; margin-bottom: 10px; text-align: center;">
            {{ session('error') }}
        </div>
           @endif
           
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">SIGN IN</button>
            </form>
        </div>
    </div>
</body>
</html>
