<?php
session_start();

if (isset($_SESSION['login'])) {
	header('Location: dashboard-ui.php');
	exit;
}

$siteName = 'BR Fleet';
$siteDescription = 'A clear view of your vehicles, loads, and daily operations.';
$creator = '';
$databaseAvailable = true;

try {
	require 'dbconf.php';
	$result = $pdo->query('SELECT creator, judul, "desc" FROM setting ORDER BY id_setting LIMIT 1');
	$settings = $result->fetch();

	if ($settings) {
		$siteName = trim($settings['judul']) !== '' ? $settings['judul'] : $siteName;
		$siteDescription = trim($settings['desc']) !== '' ? $settings['desc'] : $siteDescription;
		$creator = $settings['creator'];
	}
} catch (PDOException $exception) {
	$databaseAvailable = false;
	error_log('Landing page could not load site settings: ' . $exception->getMessage());
}

$escape = static function ($value) {
	return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo $escape($siteDescription); ?>">
	<meta name="theme-color" content="#f7f5ef">
	<title><?php echo $escape($siteName); ?> — Fleet operations, in motion</title>
	<link rel="stylesheet" href="assets/landing.css">
</head>
<body>
	<a class="skip-link" href="#main">Skip to content</a>
	<header class="site-header">
		<div class="header-inner">
			<a class="brand" href="index.php" aria-label="<?php echo $escape($siteName); ?> home">
				<span class="brand-mark" aria-hidden="true">
					<svg viewBox="0 0 40 40" fill="none">
						<path d="M5 10h20v20H5z" fill="currentColor"/>
						<path d="M15 5h20v20H15z" fill="#f1a345"/>
						<path d="M20 15h10v10H20z" fill="#f7f5ef"/>
					</svg>
				</span>
				<span class="brand-name"><?php echo $escape($siteName); ?><small>FLEET OPERATIONS</small></span>
			</a>
			<nav class="main-nav" aria-label="Main navigation">
				<a href="#overview">Overview</a>
				<a href="#operations">Operations</a>
			</nav>
			<a class="header-login" href="login-ui.php">Sign in <span aria-hidden="true">↗</span></a>
		</div>
	</header>

	<main id="main">
		<?php if (!$databaseAvailable): ?>
			<div class="system-notice" role="status">
				Site settings are temporarily unavailable. The landing page is available, but signing in requires the database connection.
			</div>
		<?php endif; ?>

		<section class="hero" id="overview">
			<div class="hero-stripes" aria-hidden="true"><i></i><i></i><i></i><i></i></div>
			<div class="hero-inner">
				<div class="hero-copy">
					<p class="eyebrow"><span></span> Built for the road ahead</p>
					<h1>Keep every<br>mile <em>in motion.</em></h1>
					<p class="hero-description"><?php echo $escape($siteDescription); ?></p>
					<div class="hero-actions">
						<a class="button button-primary" href="login-ui.php">Open your fleet portal <span aria-hidden="true">↗</span></a>
						<a class="text-link" href="#operations">Explore the platform <span aria-hidden="true">↓</span></a>
					</div>
					<div class="hero-proof">
						<span class="proof-icon" aria-hidden="true">↗</span>
						<span>One workspace.<br><strong>Every moving part.</strong></span>
					</div>
				</div>
				<div class="hero-visual">
					<div class="visual-label"><span class="live-dot"></span> FLEET VIEW <span>01 / 03</span></div>
					<div class="photo-frame">
						<img src="uploads/slider/slide-2.jpg" alt="A long-haul truck on an open road at sunset">
						<div class="photo-caption">
							<span class="caption-icon" aria-hidden="true">↗</span>
							<span><small>OPERATIONS, CONNECTED</small><strong>From dispatch to destination.</strong></span>
						</div>
					</div>
					<div class="visual-index" aria-hidden="true">BR<span>.</span>01</div>
					<div class="visual-stamp" aria-hidden="true"><span>MOVE</span><span>WITH</span><strong>CLARITY</strong></div>
				</div>
			</div>
			<a class="scroll-cue" href="#operations"><span></span> SCROLL TO EXPLORE</a>
		</section>

		<section class="operations" id="operations">
			<div class="section-heading">
				<div>
					<p class="eyebrow"><span></span> The whole journey, at a glance</p>
					<h2>Less chasing.<br><em>More moving.</em></h2>
				</div>
				<p class="section-intro">Keep the details that keep your business moving in one straightforward place—from the vehicle yard to the final delivery.</p>
			</div>
			<div class="feature-grid">
				<article class="feature-card feature-dark">
					<div class="feature-top"><span>01 / VEHICLES</span><span aria-hidden="true">↗</span></div>
					<div class="feature-icon" aria-hidden="true">
						<svg viewBox="0 0 48 48" fill="none"><path d="M4 13h24v21H4zM28 21h9l7 8v5H28z" stroke="currentColor" stroke-width="2"/><circle cx="13" cy="36" r="4" fill="#f1a345"/><circle cx="36" cy="36" r="4" fill="#f1a345"/><path d="M32 23v7h9" stroke="currentColor" stroke-width="2"/></svg>
					</div>
					<h3>Know what’s<br>on the road.</h3>
					<p>Keep vehicle details, drivers, and availability easy to find.</p>
				</article>
				<article class="feature-card feature-orange">
					<div class="feature-top"><span>02 / LOADS</span><span aria-hidden="true">↗</span></div>
					<div class="feature-icon" aria-hidden="true">
						<svg viewBox="0 0 48 48" fill="none"><path d="M8 14h32v26H8zM15 14V9h18v5M16 22h16M16 29h11M16 35h7" stroke="currentColor" stroke-width="2"/><path d="m31 31 4 4 8-9" stroke="#1b2b36" stroke-width="2.5"/></svg>
					</div>
					<h3>Keep every<br>load on track.</h3>
					<p>Follow cargo and destination details through each handoff.</p>
				</article>
				<article class="feature-card feature-light">
					<div class="feature-top"><span>03 / DEPARTURES</span><span aria-hidden="true">↗</span></div>
					<div class="feature-icon" aria-hidden="true">
						<svg viewBox="0 0 48 48" fill="none"><circle cx="24" cy="25" r="16" stroke="currentColor" stroke-width="2"/><path d="M24 15v11l8 5M18 5h12M24 5v4" stroke="currentColor" stroke-width="2"/><path d="m8 10 4 4" stroke="#f1a345" stroke-width="3"/></svg>
					</div>
					<h3>Make the next<br>move on time.</h3>
					<p>See arrival, loading, and departure milestones in one view.</p>
				</article>
			</div>
		</section>

		<section class="closing">
			<div class="closing-mark" aria-hidden="true">BR<span>.</span></div>
			<div><p class="eyebrow"><span></span> Your operation starts here</p><h2>Ready when<br><em>you are.</em></h2></div>
			<a class="button button-light" href="login-ui.php">Sign in to your fleet portal <span aria-hidden="true">↗</span></a>
		</section>
	</main>

	<footer class="site-footer">
		<a class="brand brand-footer" href="index.php">
			<span class="brand-mark" aria-hidden="true"><svg viewBox="0 0 40 40" fill="none"><path d="M5 10h20v20H5z" fill="currentColor"/><path d="M15 5h20v20H15z" fill="#f1a345"/><path d="M20 15h10v10H20z" fill="#f7f5ef"/></svg></span>
			<span class="brand-name"><?php echo $escape($siteName); ?><small>FLEET OPERATIONS</small></span>
		</a>
		<p>Made for the people who keep things moving.</p>
		<span class="copyright">&copy; <?php echo date('Y'); ?><?php if (trim($creator) !== ''): ?> &middot; <?php echo $escape($creator); ?><?php endif; ?></span>
	</footer>
</body>
</html>
