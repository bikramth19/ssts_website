# Shestrong Technology Services Website

Static responsive website for shestrong.in.

## Files
- `index.html` – Home
- `about.html` – About Us
- `services.html` – Services overview
- Dedicated service pages for healthcare, education, web/app, payment gateway, CCTV and testing/consulting
- `portfolio.html` – Portfolio / Projects
- `contact.html` – Contact page
- `assets/css/styles.css` – Global responsive styling
- `assets/js/main.js` – Mobile menu, scroll reveal, interaction effects
- `assets/img/` – SVG logo and illustrations

## Deployment
Upload all files to the root of your hosting for `shestrong.in`.
Update placeholder phone/WhatsApp/social links in the footer and contact page before going live.

## Contact form
The contact form currently uses `mailto:contact@shestrong.in` for static hosting. Connect it to your backend, Formspree, Netlify Forms, or a custom API route for production.


## Update Summary
- Font updated to **Poppins**.
- Added interactive 3D hover tilt cards and cursor-responsive animated background.
- Added generated visual assets inside `assets/img/generated/`.
- Contact form upgraded to **PHP + MySQL** with handler at `php/contact-submit.php`.
- Database schema is available at `database/shestrong_contact_form.sql`.
- Update DB credentials in `php/config/config.php` before deployment.
