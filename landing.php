<?php
// Public landing page. Reads slider filenames straight from the setting table,
// so it works without logging in first.
include 'dbconf.php'; // provides $pdo

$slides = [];
try {
    $row = $pdo->query('SELECT slider1, slider2, slider3 FROM setting LIMIT 1')->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        foreach (['slider1', 'slider2', 'slider3'] as $k) {
            if (!empty($row[$k]) && is_file('uploads/slider/' . $row[$k])) {
                $slides[] = 'uploads/slider/' . rawurlencode($row[$k]);
            }
        }
    }
} catch (Exception $e) {
    // No settings yet: the hero falls back to a plain background.
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Farm Supplies - Gate and Warehouse Tracking</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;600;800&display=swap" rel="stylesheet">
<style>
:root{--ink:#14201a;--field:#1f3d2b;--hay:#e0a82e;--paper:#f6f7f4;--mute:#5b675f}
*{box-sizing:border-box}
body{margin:0;font-family:Archivo,system-ui,sans-serif;color:var(--ink);background:var(--paper);line-height:1.6}
a{color:inherit}
:focus-visible{outline:3px solid var(--hay);outline-offset:3px}
header{position:absolute;inset:0 0 auto 0;z-index:3;display:flex;justify-content:space-between;align-items:center;padding:20px clamp(20px,5vw,64px);color:#fff}
.brand{font-weight:800;font-size:1.15rem;text-decoration:none}
.login{background:var(--hay);color:var(--ink);padding:10px 20px;border-radius:4px;font-weight:600;text-decoration:none}
.hero{position:relative;min-height:88vh;display:flex;align-items:flex-end;background:var(--field);color:#fff;overflow:hidden}
.slide{position:absolute;inset:0;background-size:cover;background-position:center;opacity:0;transition:opacity 1.2s}
.slide.on{opacity:1}
.hero::after{content:"";position:absolute;inset:0;background:linear-gradient(to top,rgba(10,20,14,.88),rgba(10,20,14,.15) 70%)}
.hero-text{position:relative;z-index:2;padding:0 clamp(20px,5vw,64px) 64px;max-width:760px}
h1{font-size:clamp(2.2rem,6vw,4.2rem);line-height:1.05;margin:0 0 16px;font-weight:800}
.hero p{font-size:1.15rem;max-width:52ch;margin:0 0 28px}
.cta{display:inline-block;background:var(--hay);color:var(--ink);padding:14px 26px;border-radius:4px;font-weight:600;text-decoration:none}
section{padding:72px clamp(20px,5vw,64px)}
h2{font-size:clamp(1.6rem,3.5vw,2.3rem);margin:0 0 32px;max-width:20ch;line-height:1.15}
.cols{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:40px;max-width:1000px}
.cols h3{margin:0 0 8px;font-size:1.1rem;border-top:4px solid var(--hay);padding-top:14px}
.cols p{margin:0;color:var(--mute)}
footer{background:var(--field);color:#dfe7e1;padding:40px clamp(20px,5vw,64px);display:flex;flex-wrap:wrap;gap:24px;justify-content:space-between}
footer p{margin:0}
@media (prefers-reduced-motion:reduce){.slide{transition:none}}
</style>
</head>
<body>
<header>
  <a class="brand" href="landing.php">Farm Supplies</a>
  <a class="login" href="login-ui.php">Staff login</a>
</header>

<div class="hero">
  <?php foreach ($slides as $i => $src): ?>
    <div class="slide<?= $i === 0 ? ' on' : '' ?>" style="background-image:url('<?= htmlspecialchars($src, ENT_QUOTES) ?>')"></div>
  <?php endforeach; ?>
  <div class="hero-text">
    <h1>Every truck in and out, on record.</h1>
    <p>Gate guards and warehouse staff log arrivals, loads and departures in one place, so stock never goes missing between the road and the shelf.</p>
    <a class="cta" href="login-ui.php">Log in to the system</a>
  </div>
</div>

<section>
  <h2>Built for the people on the ground</h2>
  <div class="cols">
    <div><h3>Gate guards</h3><p>Record each vehicle and driver the moment they arrive or leave.</p></div>
    <div><h3>Warehouse admins</h3><p>See what is waiting to be unloaded and what has left with each truck.</p></div>
    <div><h3>Managers</h3><p>Review the full movement history and adjust site settings.</p></div>
  </div>
</section>

<footer>
  <p><strong>Farm Supplies</strong><br>Your address and phone number here</p>
  <p>Questions about access? Ask your site administrator.</p>
</footer>

<script>
(function(){
  var s=document.querySelectorAll('.slide');
  if(s.length<2||window.matchMedia('(prefers-reduced-motion: reduce)').matches)return;
  var i=0;
  setInterval(function(){
    s[i].classList.remove('on');
    i=(i+1)%s.length;
    s[i].classList.add('on');
  },5000);
})();
</script>
</body>
</html>