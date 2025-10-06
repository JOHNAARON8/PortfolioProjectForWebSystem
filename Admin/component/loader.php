<?php
$redirectUrl = "../Pages/Dash.php";
$loadingDuration = 4; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loading...</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --primary: #111827;
      --accent1: #facc15;
      --accent2: #22d3ee;
      --accent3: #f472b6;
    }
    body {
      background-color: var(--primary);
      color: #fff;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .loading-container {
      text-align: center;
    }
    .meme {
      font-size: 2rem;
      font-weight: bold;
      background: linear-gradient(90deg, var(--accent1), var(--accent2), var(--accent3));
      background-clip: text;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      animation: rainbow 3s linear infinite;
    }
    @keyframes rainbow {
      0% { filter: hue-rotate(0deg); }
      100% { filter: hue-rotate(360deg); }
    }
    .dance {
      font-size: 3rem;
      margin: 20px 0;
      animation: dance 1s infinite;
    }
    @keyframes dance {
      0% { transform: rotate(0deg) translateY(0); }
      25% { transform: rotate(10deg) translateY(-10px); }
      50% { transform: rotate(0deg) translateY(0); }
      75% { transform: rotate(-10deg) translateY(-10px); }
      100% { transform: rotate(0deg) translateY(0); }
    }
    .progress-bar {
      width: 300px;
      height: 10px;
      background: rgba(255,255,255,0.2);
      margin: 20px auto;
      border-radius: 5px;
      overflow: hidden;
    }
    .progress {
      height: 100%;
      width: 0;
      background: linear-gradient(90deg, var(--accent1), var(--accent2), var(--accent3));
      animation: progress <?php echo $loadingDuration; ?>s linear forwards;
    }
    @keyframes progress {
      0% { width: 0; }
      100% { width: 100%; }
    }
  </style>
</head>
<body>
  <div class="loading-container">
    <div class="meme">Loading like a boss...</div>
    <div class="dance">🕺💃</div>
    <div class="progress-bar">
      <div class="progress"></div>
    </div>
    <div class="meme">Please wait 😎</div>
  </div>

  <script>
    setTimeout(function() {
      window.location.href = "<?php echo $redirectUrl; ?>";
    }, <?php echo $loadingDuration * 1000; ?>);
  </script>
</body>
</html>
