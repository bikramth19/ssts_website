<?php
$status = $_GET["status"] ?? "";
$alertClass = "";
$alertMessage = "";
if ($status === "success") {
  $alertClass = "success";
  $alertMessage = "Thank you! Your enquiry has been saved successfully. Our team will contact you soon.";
} elseif ($status === "error") {
  $alertClass = "error";
  $alertMessage = "Sorry, something went wrong while saving your enquiry. Please try again or contact us directly.";
} elseif ($status === "invalid") {
  $alertClass = "error";
  $alertMessage = "Please complete all required fields correctly.";
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contact Shestrong Technology Services | Get a Free Consultation</title>
  <meta name="description" content="Contact Shestrong Technology Services for software development, healthcare software, education portals, payment gateway integration, web apps, CCTV and IT consulting." />
  <meta name="keywords" content="contact software development company India, Shestrong Technology Services contact" />
  <link rel="canonical" href="https://shestrong.in/contact.php" />
  <meta property="og:title" content="Contact Shestrong Technology Services | Get a Free Consultation" />
  <meta property="og:description" content="Contact Shestrong Technology Services for software development, healthcare software, education portals, payment gateway integration, web apps, CCTV and IT consulting." />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://shestrong.in/contact.php" />
  <meta property="og:image" content="https://shestrong.in/assets/img/og-image.svg" />
  <meta name="theme-color" content="#4b126d" />
  <link rel="icon" href="assets/img/favicon.svg" type="image/svg+xml" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/styles.css" />
  <script type="application/ld+json">{"@context": "https://schema.org", "@type": "Organization", "name": "Shestrong Technology Services", "url": "https://shestrong.in/", "email": "contact@shestrong.in", "description": "Women empowerment-focused technology company providing software development, IT consulting, testing, healthcare software, education software, payment gateway integration, ecommerce, mobile apps and CCTV live camera web solutions.", "sameAs": []}</script>
</head>
<body>
  <div class="page-loader" aria-hidden="true"><span></span></div>
  <div class="interactive-backdrop" aria-hidden="true">
    <span class="bg-sphere sphere-a"></span>
    <span class="bg-sphere sphere-b"></span>
    <span class="bg-sphere sphere-c"></span>
    <span class="bg-blob blob-a"></span>
    <span class="bg-blob blob-b"></span>
    <span class="bg-blob blob-c"></span>
    <span class="bg-grid"></span>
  </div>
  
    <header class="site-header" id="top">
      <div class="container nav-shell">
        <a class="brand" href="index.html" aria-label="Shestrong Technology Services home">
          <img src="assets/img/logo.svg" alt="Shestrong Technology Services logo" />
          <span><strong>Shestrong</strong><small>Technology Services</small></span>
        </a>
        <nav class="main-nav" aria-label="Primary navigation">
          <a class="nav-link " href="index.html">Home</a><a class="nav-link " href="about.html">About</a><a class="nav-link " href="services.html">Services</a><a class="nav-link " href="portfolio.html">Portfolio</a><a class="nav-link active" href="contact.php">Contact</a>
          <div class="nav-dropdown">
            <button class="nav-link dropdown-toggle" type="button">Solutions</button>
            <div class="dropdown-menu"><a href="healthcare-software.html">Healthcare Software</a><a href="education-software.html">Education Software</a><a href="web-app-development.html">Web Application Development</a><a href="web-app-development.html#website-design">Website Design & Development</a><a href="web-app-development.html#ecommerce-apps">Ecommerce & Mobile App Development</a><a href="cctv-live-camera-web-solutions.html">CCTV Live Camera Web Management</a><a href="payment-gateway-integration.html#indian-payment-gateways">Indian Payment Gateway Integration</a><a href="payment-gateway-integration.html#crypto-payment-gateways">Worldwide Crypto Payment Gateway Integration</a></div>
          </div>
        </nav>
        <div class="nav-actions">
          <a class="btn btn-small btn-ghost" href="contact.php">Free Consultation</a>
          <button class="menu-toggle" id="menuToggle" aria-label="Open menu" aria-expanded="false"><span></span><span></span><span></span></button>
        </div>
      </div>
      <div class="mobile-panel" id="mobilePanel">
        <a class="nav-link " href="index.html">Home</a><a class="nav-link " href="about.html">About</a><a class="nav-link " href="services.html">Services</a><a class="nav-link " href="portfolio.html">Portfolio</a><a class="nav-link active" href="contact.php">Contact</a>
        
        <div class="mobile-solutions">
          <strong>Solutions</strong>
          <a href="healthcare-software.html">Healthcare Software</a>
          <a href="education-software.html">Education Software</a>
          <a href="web-app-development.html">Web & App Development</a>
          <a href="payment-gateway-integration.html">Payment Gateway</a>
          <a href="cctv-live-camera-web-solutions.html">CCTV Web Solutions</a>
          <a href="software-testing-it-consulting.html">Testing & Consulting</a>
        </div>
        <a class="btn btn-primary" href="contact.php">Get a Free Consultation</a>
      </div>
    </header>
  <main>
<section class="inner-hero page-hero contact-hero">
  <div class="container page-hero-grid">
    <div class="page-hero-copy"><p class="eyebrow reveal">Contact Us</p><h1 class="reveal">Tell us your idea. We will help you turn it into a secure and scalable digital solution.</h1><p class="reveal">Reach out for software development, healthcare software, education portals, payment gateway integration, website development, ecommerce, app development, CCTV live streaming setup and IT consulting.</p></div>
    <div class="page-hero-media reveal flash-card"><img src="assets/img/generated/testing-consulting.png" class="media-cover" alt="Consultation and IT planning illustration" /></div>
  </div>
</section>
<section class="section-pad">
  <div class="container contact-grid">
    <form class="contact-form reveal tilt" id="contactForm" action="php/contact-submit.php" method="post">
      <?php if ($alertMessage): ?>
      <div class="form-alert <?php echo htmlspecialchars($alertClass); ?>"><?php echo htmlspecialchars($alertMessage); ?></div>
      <?php endif; ?>
      <input type="hidden" name="website" value="" />
      <div class="form-row"><label>Name<input type="text" name="name" required placeholder="Your full name" /></label><label>Phone<input type="tel" name="phone" required placeholder="Your phone number" /></label></div>
      <label>Email<input type="email" name="email" required placeholder="you@example.com" /></label>
      <label>Service Interested In<select name="service" required><option value="">Select a service</option><option>Healthcare Software</option><option>Education Software</option><option>Web Application Development</option><option>Website Design &amp; Development</option><option>Ecommerce &amp; Mobile App Development</option><option>CCTV Live Camera Web Management</option><option>Indian Payment Gateway Integration</option><option>Worldwide Crypto Payment Gateway Integration</option><option>Software Testing</option><option>IT Consulting</option></select></label>
      <label>Message<textarea name="message" rows="6" required placeholder="Tell us about your project requirement"></textarea></label>
      <button class="btn btn-primary" type="submit">Send Enquiry</button>
      <p class="form-note" id="formNote">This contact form is ready for PHP + MySQL. Update php/config/config.php with your database details before deployment.</p>
    </form>
    <aside class="contact-panel reveal tilt">
      <div class="contact-item"><span><svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07A19.5 19.5 0 0 1 3.15 10.8 19.8 19.8 0 0 1 .08 2.18 2 2 0 0 1 2.06 0h3a2 2 0 0 1 2 1.72c.13.96.35 1.9.67 2.8a2 2 0 0 1-.45 2.11L6 7.91a16 16 0 0 0 6.09 6.09l1.28-1.28a2 2 0 0 1 2.11-.45c.9.32 1.84.54 2.8.67A2 2 0 0 1 22 16.92z"/></svg></span><div><h3>WhatsApp / Phone</h3><p><a href="https://wa.me/919999999999" target="_blank" rel="noopener">Chat on WhatsApp</a><br><a href="tel:+919999999999">+91 99999 99999</a></p></div></div>
      <div class="contact-item"><span><svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="3"/><path d="M3 7l9 7 9-7"/></svg></span><div><h3>Email</h3><p><a href="mailto:contact@shestrong.in">contact@shestrong.in</a></p></div></div>
      <div class="contact-item"><span><svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s7-6 7-13a7 7 0 1 0-14 0c0 7 7 13 7 13z"/><circle cx="12" cy="9" r="2.5"/></svg></span><div><h3>Location</h3><p>India<br>Website: <a href="https://shestrong.in">shestrong.in</a></p></div></div>
      <div class="contact-highlight"><h3>Popular enquiries</h3><p>Clinic Management Software · Pharmacy Management System · School Management Software · College Student Portal Development · Payment Gateway Integration India · CCTV Live Camera Web Integration</p></div>
    </aside>
  </div>
</section>
</main>
  
    <footer class="site-footer">
      <div class="footer-aurora"></div>
      <div class="container footer-grid">
        <div class="footer-brand">
          <a class="brand footer-logo" href="index.html"><img src="assets/img/logo.svg" alt="Shestrong logo" /><span><strong>Shestrong</strong><small>Technology Services</small></span></a>
          <p>Empowering businesses through technology.</p>
          <div class="social-row" aria-label="Social media links"><a href="#" aria-label="LinkedIn">in</a><a href="#" aria-label="Instagram">ig</a><a href="#" aria-label="Facebook">fb</a></div>
        </div>
        <div><h3>Quick Links</h3><ul><li><a href="index.html">Home</a></li><li><a href="about.html">About</a></li><li><a href="services.html">Services</a></li><li><a href="portfolio.html">Portfolio</a></li><li><a href="contact.php">Contact</a></li></ul></div>
        <div><h3>Services</h3><ul><li><a href="healthcare-software.html">Healthcare Software</a></li><li><a href="education-software.html">Education Software</a></li><li><a href="web-app-development.html">Web Application Development</a></li><li><a href="web-app-development.html#website-design">Website Design & Development</a></li><li><a href="web-app-development.html#ecommerce-apps">Ecommerce & Mobile App Development</a></li><li><a href="cctv-live-camera-web-solutions.html">CCTV Live Camera Web Management</a></li><li><a href="payment-gateway-integration.html#indian-payment-gateways">Indian Payment Gateway Integration</a></li><li><a href="payment-gateway-integration.html#crypto-payment-gateways">Worldwide Crypto Payment Gateway Integration</a></li></ul></div>
        <div><h3>Contact</h3><ul class="footer-contact"><li><svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="3"/><path d="M3 7l9 7 9-7"/></svg> <a href="mailto:contact@shestrong.in">contact@shestrong.in</a></li><li><svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07A19.5 19.5 0 0 1 3.15 10.8 19.8 19.8 0 0 1 .08 2.18 2 2 0 0 1 2.06 0h3a2 2 0 0 1 2 1.72c.13.96.35 1.9.67 2.8a2 2 0 0 1-.45 2.11L6 7.91a16 16 0 0 0 6.09 6.09l1.28-1.28a2 2 0 0 1 2.11-.45c.9.32 1.84.54 2.8.67A2 2 0 0 1 22 16.92z"/></svg> <a href="tel:+919999999999">+91 99999 99999</a></li><li><svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s7-6 7-13a7 7 0 1 0-14 0c0 7 7 13 7 13z"/><circle cx="12" cy="9" r="2.5"/></svg> India · shestrong.in</li></ul><a class="btn btn-light" href="contact.php">Contact Shestrong Today</a></div>
      </div>
      <div class="container footer-bottom"><p>© 2026 Shestrong Technology Services. All Rights Reserved.</p><a href="#top">Back to top ↑</a></div>
    </footer>
  <script src="assets/js/main.js"></script>
</body>
</html>