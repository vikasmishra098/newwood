<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wood Edge Tooling</title>

  <style>
    /* Reset & Font */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
     
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      color: #222;
    }

    img.logo {
      width: 160px;
      margin-bottom: 20px;
      transition: transform 0.3s ease;
    }

    img.logo:hover {
      transform: scale(1.05);
    }

    h1 {
      font-size: 28px;
      font-weight: 600;
      margin-bottom: 20px;
      color: #2b2b2b;
      letter-spacing: 0.5px;
    }

    a.login-btn {
      display: inline-block;
      background: #2e5bff;
      color: white;
      padding: 12px 28px;
      border-radius: 30px;
      text-decoration: none;
      font-weight: 500;
      box-shadow: 0 5px 15px rgba(46, 91, 255, 0.3);
      transition: all 0.3s ease;
    }

    a.login-btn:hover {
      background: #2447cc;
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(46, 91, 255, 0.4);
    }

    /* Floating APK download button */
    .apk-download {
      position: fixed;
      bottom: 25px;
      right: 25px;
      z-index: 1000;
      text-align: center;
    }

    .apk-download img {
      width: 180px;
      cursor: pointer;
      transition: transform 0.3s ease, filter 0.3s ease;
      filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.2));
    }

    .apk-download img:hover {
      transform: scale(1.1);
      filter: drop-shadow(0 6px 15px rgba(0, 0, 0, 0.25));
    }

    /* Small screen adjustments */
    @media (max-width: 600px) {
      h1 {
        font-size: 22px;
      }
      a.login-btn {
        padding: 10px 22px;
        font-size: 15px;
      }
      .apk-download img {
        width: 140px;
      }
    }
  </style>
</head>

<body>
  <div>
    <img class="logo" src="https://www.woodedgetooling.com/admin/uploads/logo.png" alt="Wood Edge Tooling Logo">
    <h1>Welcome to Wood Edge Tooling</h1>
    <a href="{{ url('/home') }}" class="login-btn">Continue to Login</a>
  </div>

  <a href="assets/app/WoodEdgeTooling.apk" class="apk-download" title="Download our Android App">
    <img src="assets/img/image-removebg-preview.png" alt="Download APK">
  </a>
</body>
</html>
