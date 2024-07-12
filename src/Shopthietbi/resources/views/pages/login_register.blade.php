<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/c/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
    <link rel="stylesheet" href="{{asset('public/frontend/css/style_login.css')}}">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://kit.fontawesome.com/f2ab765498.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="{{asset('public/frontend/images/frontImg.jpg')}}" alt="">
        <div class="text">
          <span class="text-1">Shop thiết bị điện tử</span>
          <span class="text-2">Đa dạng - Tiện lợi - Nhanh chóng</span>
        </div>
      </div>
      <div class="back">
        <img class="backImg" src="{{asset('public/frontend/images/backtImg.jpg')}}" alt="">
        <div class="text">
          <span class="text-1">Complete miles of journey <br> with one step</span>
          <span class="text-2">Let's get started</span>
        </div>
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <a href="{{URL::to('/')}}"><i class="fa-solid fa-house" style="color: #08C"></i></a>
            <div class="title">Đăng nhập</div>
          <form action="{{URL::to('/login')}}" method="POST">
            {{ csrf_field() }}
            <div class="input-boxes">
              <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo "<div class='alert alert-danger'>$message</div>";
                        Session::put('message', null);
                    }
                    ?>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="email" name="login_email" placeholder="Email đăng nhập" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="login_password" placeholder="Mật khẩu" required>
              </div>
              
              <div class="button input-box">
                <input type="submit" value="Đăng nhập">
              </div>
              <p style="text-align: center;">Hoặc</p>
              <div>
                <a 
                style="
                color:black;
                background: white;
                justify-content: center;
                height: 50px;
                width:100%;
                display: flex;
                align-items: center;
                font-size: 16px;
                font-weight: 500;
                text-decoration: none;
                border-radius: 6px;
                box-shadow: 1px 1px 5px -2px;
                " href="{{URL::to('/login-google')}}"><?xml version="1.0" ?><svg style=" height: 20px;" viewBox="0 0 533.5 544.3" xmlns="http://www.w3.org/2000/svg"><path d="M533.5 278.4c0-18.5-1.5-37.1-4.7-55.3H272.1v104.8h147c-6.1 33.8-25.7 63.7-54.4 82.7v68h87.7c51.5-47.4 81.1-117.4 81.1-200.2z" fill="#4285f4"/><path d="M272.1 544.3c73.4 0 135.3-24.1 180.4-65.7l-87.7-68c-24.4 16.6-55.9 26-92.6 26-71 0-131.2-47.9-152.8-112.3H28.9v70.1c46.2 91.9 140.3 149.9 243.2 149.9z" fill="#34a853"/><path d="M119.3 324.3c-11.4-33.8-11.4-70.4 0-104.2V150H28.9c-38.6 76.9-38.6 167.5 0 244.4l90.4-70.1z" fill="#fbbc04"/><path d="M272.1 107.7c38.8-.6 76.3 14 104.4 40.8l77.7-77.7C405 24.6 339.7-.8 272.1 0 169.2 0 75.1 58 28.9 150l90.4 70.1c21.5-64.5 81.8-112.4 152.8-112.4z" fill="#ea4335"/></svg><p style="margin-left: 5px;">Đăng nhập</p></a>
              </div>
              <div class="text sign-up-text">Chưa có tài khoản? <label for="flip">Đăng ký</label></div>
            </div>
        </form>
      </div>
        <div class="signup-form">
          <a href="{{URL::to('/')}}"><i class="fa-solid fa-house" style="color: #08C"></i></a>
          <div class="title">Đăng ký</div>
        <form action="{{URL::to('/add-customer')}}" method="POST">
          {{ csrf_field() }}
            <div class="input-boxes">
              <?php
                    $message = Session::get('message-register');
                    if ($message) {
                        echo "<div class='alert alert-danger'>$message</div>";
                        Session::put('message-register', null);
                    }
                    ?>
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" name="register_name" placeholder="Tên đăng ký" required>
              </div>
             
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="email" name="register_email" placeholder="Email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="register_password" placeholder="Mật khẩu" required>
              </div>
             
              <div class="button input-box">
                <input type="submit" value="Đăng ký">
              </div>
              <div class="text sign-up-text">Bạn đã có tài khoản? <label for="flip">Đăng nhập</label></div>
            </div>
      </form>
    </div>
    </div>
    </div>
  </div>
</body>
</html>
