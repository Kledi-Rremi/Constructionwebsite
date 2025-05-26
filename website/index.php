<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!--=============== FAVICON ===============-->
   <link rel="shortcut icon" href="assets/img/logogoogle.png" type="image/x-icon">

   <!--=============== REMIXICONS ===============-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">

   <!--=============== SWIPER CSS ===============-->
   <link rel="stylesheet" href="assets/swiper-bundle.min.css">

   <!--=============== CSS ===============-->
   <link rel="stylesheet" href="assets/style.css">
   
   <title>Construction website</title>

   <!--=============== MODEL VIEWER ===============-->
   <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
</head>
<body>
   <!--==================== HEADER ====================-->
   <header class="header" id="header">
     <nav class="nav container">
         <a href="#" class="nav__logo">
           <i class="ri-building-line"></i>
           <span>Brik</span>
         </a>
         <div class="nav__menu" id="nav-menu">
           <ul class="nav__list">
             <li><a href="#home" class="nav__link active-link">Home</a></li>
             <li><a href="#about" class="nav__link">About us</a></li>
             <li><a href="#services" class="nav__link">Services</a></li>
             <li><a href="#projects" class="nav__link">Projects</a></li>
             <li><a href="#contact" class="nav__link button">Contact us</a></li>
           </ul>
           <!-- Close menu -->
           <div class="nav__close" id="nav-close">
             <i class="ri-close-large-line"></i>
           </div>
         </div>
         <!-- Toggle menu -->
         <div class="nav__toggle" id="nav-toggle">
           <i class="ri-apps-line"></i>
         </div>
       </nav>
   </header>

   <!--==================== MAIN ====================-->
   <main class="main">
      <!--==================== HOME ====================-->
      <section class="home section" id="home">
        <div class="home__container container">
          <div class="home__content grid">
            <div class="home__data">
              <h1 class="home__title">Building Dreams<br> One <span class="highlight">Brik'</span> at a Time <br><span class="highlight">Together</span></h1>
              <p class="home__description"></p>
              <div class="home__buttons">
                <a href="#services" class="button button--yellow">Our Services</a>
                <a href="#projects" class="button__link">
                  <span>View Projects</span>
                  <i class="ri-arrow-right-line"></i>
                </a>
              </div>
              <div class="home__info-wrapper">
                <div class="home__info">
                  <h3 class="home__info-title">20+</h3>
                  <p class="home__info-description">Years of <br> experience</p>
                </div>
                <div class="home__info">
                  <h3 class="home__info-title">200</h3>
                  <p class="home__info-description">Completed <br> Projects</p>
                </div>
              </div>
            </div>
          </div>
          <div class="home__model-wrapper">
            <model-viewer src="assets/img/fbx.glb"
              alt="3D model"
              auto-rotate
              auto-rotate-speed="13"
              camera-controls
              disable-zoom
              style="width: 320px; height: 320px; background: transparent;">
            </model-viewer>
            <div class="hard-hat-shadow"></div>
          </div>
        </div>
      </section>

      <!--==================== ABOUT ====================-->
      <section class="about section" id="about">
      <div class="about__container grid">
          <div class="about__data">
            <span class="about__subtitle">Why choose us</span>
            <h2 class="section__title">Where ideas rise into reality</h2>
            <p class="about__description">
             When construction delays and rising costs hit hard in 2018, Brik stepped in to build differently.
We turn blueprints into reality with precision, passion, and reliability. <br>From residential to commercial and infrastructure projects, we deliver quality from the ground up. Every build starts with a clear 3D plan and a milestone-driven schedule—so you know exactly what to expect. With eco-friendly materials and open communication, we deliver on time, without surprises.
            </p>
            <ul class="about__list grid">
              <li class="about__list-item">
                <i class="ri-checkbox-line"></i>
                <span>Professional workers</span>
              </li>
              <li class="about__list-item">
                <i class="ri-checkbox-line"></i>
                <span>Guaranteed quality</span>
              </li>
              <li class="about__list-item">
                <i class="ri-checkbox-line"></i>
                <span>Extensive experience</span>
              </li>
              <li class="about__list-item">
                <i class="ri-checkbox-line"></i>
                <span>We quote your projects</span>
              </li>
            </ul>
            <a href="#contact" class="button">Start Your Project</a>
          </div>
          <div class="about__video-wrapper" style="flex:1; display:flex; justify-content:center; align-items:center; margin:0; padding:0;">
           <iframe width="100%" height="400" src="https://www.youtube.com/embed/k2SWAC9SIm0?rel=0"
                    title="YouTube video player" frameborder="0"
                     allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    style="background:#fafafa; border-radius:16px; display:block; margin:0; padding:0;">
</iframe>
</div>
          </div>
        </div>
    <div class="testimonials">
  <h3 class="testimonials__title">Hear from our clients</h3>
  <p class="testimonials__subtitle">
    Here’s what they say:
  </p>
  <div class="testimonials__grid">
    <div class="testimonial-card active">
      <div class="card-up" style="background-color: #efc314;"></div>
      <div class="avatar">
        <img src="assets/img/people2.jpg" alt="Maria Smantha" class="rounded-circle img-fluid">
      </div>
      <div class="card-body">
        <h4>Maria Smantha</h4>
        <hr>
        <p>
          <span class="testimonial-stars">★★★★★</span><br>
          "Brik made our dream home a reality. Highly recommended!"
        </p>
      </div>
    </div>
    <div class="testimonial-card">
      <div class="card-up" style="background-color: #e99221;"></div>
      <div class="avatar">
        <img src="assets/img/people3.jpg" alt="Lisa Cudrow" class="rounded-circle img-fluid">
      </div>
      <div class="card-body">
        <h4>Lisa Cudrow</h4>
        <hr>
        <p>
          <span class="testimonial-stars">★★★★★</span><br>
          "Professional team, great communication, and on-time delivery."
        </p>
      </div>
    </div>
    <div class="testimonial-card">
      <div class="card-up" style="background-color: #e10c0c;"></div>
      <div class="avatar">
        <img src="assets/img/people1.jpg" alt="John Smith" class="rounded-circle img-fluid">
      </div>
      <div class="card-body">
        <h4>John Smith</h4>
        <hr>
        <p>
          <span class="testimonial-stars">★★★★★</span><br>
          "Excellent quality and attention to detail. Will hire again!"
        </p>
      </div>
    </div>
  </div>
  <div class="testimonials__arrows">
    <button class="testimonial-arrow" id="testimonial-prev">&#8592;</button>
    <button class="testimonial-arrow" id="testimonial-next">&#8594;</button>
  </div>
</div>
      </section>

   <!--==================== SERVICES ====================-->
<section class="services section" id="services">
  <div class="services__container">
    <div class="services__data">
      <span class="section__subtitle">Our services</span>
      <h2 class="section__title">High quality <br> construction services</h2>
      <p class="services__description">
        We offer a wide range of construction services to meet your needs. From residential to commercial projects, we have the expertise and experience to deliver high-quality results.
      </p>
      <a href="#contact" class="button">Get a quote</a>
    </div>

    <div class="services__swiper swiper">
  <div class="swiper-wrapper">
    <?php
    require_once __DIR__ . '/db.php';
    $stmt = $pdo->query("SELECT * FROM services WHERE is_active=1 ORDER BY display_order ASC, id ASC");
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($services as $service): ?>
      <article class="services__card swiper-slide">
        <div class="services__icon">
          <i class="<?= htmlspecialchars($service['icon']) ?>"></i>
        </div>
        <h3 class="services__title"><?= nl2br(htmlspecialchars($service['title'])) ?></h3>
        <p><?= htmlspecialchars($service['description']) ?></p>
      </article>
    <?php endforeach; ?>
  </div>
</div>
       
    <!-- Navigation Buttons -->
    <div class="swiper-button-prev">
      <i class="ri-arrow-left-line"></i>
    </div>
    <div class="swiper-button-next">
      <i class="ri-arrow-right-line"></i>
    </div>
    <div class="services__shape"></div>
  </div>
</section>

      
    <!--==================== PROJECTS ====================-->
<section class="projects section" id="projects">
  <span class="section__subtitle">Our projects</span>
  <h2 class="section__title">Latest completed <br> projects</h2>
  <div class="swiper projects__swiper">
    <div class="swiper-wrapper">
      <?php
      

      $stmt_projects = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC, id DESC");
      $projects = $stmt_projects->fetchAll(PDO::FETCH_ASSOC);
      foreach ($projects as $project):
      ?>
      <article class="projects__card swiper-slide">
        <?php if (!empty($project['image_path']) && file_exists($project['image_path'])): ?>
          <img src="<?= htmlspecialchars($project['image_path']) ?>" alt="<?= htmlspecialchars($project['name']) ?> Project" class="projects__img">
        <?php else: ?>
          <img src="assets/img/default-project.png" alt="Default Project Image" class="projects__img"> <!-- Optional: a default image -->
        <?php endif; ?>
        <div class="projects__data">
          <h2 class="projects__title"><?= htmlspecialchars($project['name']) ?></h2>
          <span class="project__date"><?= htmlspecialchars(date("F j Y", strtotime($project['created_at']))) ?></span>
          <p>
            <?= nl2br(htmlspecialchars($project['description'])) ?>
          </p>
        </div>
      </article>
      <?php endforeach; ?>
      <?php if (empty($projects)): ?>
        <p style="text-align:center; width:100%; padding: 20px;">No projects found at the moment.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

      <!--==================== CONTACT ====================-->
      <section class="contact section" id="contact">
      <div class="contact__top-info">
        <div class="contact__info-block">
      <div class="contact__icon"><i class="ri-map-pin-2-line"></i></div>
      <div>
        <strong>Address:</strong><br>
        Tirana, Albania<br>
        <a href="https://www.google.com/maps/place/Tiran%C3%AB/@41.2562757,19.7080633,11z/data=!4m6!3m5!1s0x1350310470fac5db:0x40092af10653720!8m2!3d41.3275459!4d19.8186982!16zL20vMDdtX2Y?entry=ttu&g_ep=EgoyMDI1MDUxNS4wIKXMDSoASAFQAw%3D%3D" target="_blank">View on Google Maps</a>
      </div>
    </div>
    <div class="contact__info-block">
      <div class="contact__icon"><i class="ri-phone-line"></i></div>
      <div>
        <strong>Phone:</strong><br>
        <a href="tel:+355661234567">+355 66 123 4567</a>
      </div>
    </div>
    <div class="contact__info-block">
      <div class="contact__icon"><i class="ri-mail-unread-line"></i></div>
      <div>
        <strong>Email:</strong><br>
        <a href="mailto:info@brik.com">info@brik.com</a>
      </div>
    </div>
  </div>
  <div class="contact__main">
    
    <form class="contact__form" action="contact_submit.php" method="POST">
  <h3>Contact Us</h3>
  <div class="contact__form-row">
    <div class="contact__form-group"> 
      <label for="fullname">Full Name</label>
      <input type="text" id="fullname" name="fullname" placeholder="Name" required>
    </div>
    <div class="contact__form-group">
      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" placeholder="Email" required>
    </div>
  </div>
  <div class="contact__form-group">
    <label for="subject">Subject</label>
    <input type="text" id="subject" name="subject" placeholder="Subject">
  </div>
  <div class="contact__form-group">
    <label for="message">Message</label>
    <textarea id="message" name="message" placeholder="Message" required></textarea>
  </div>
  <button type="submit" class="contact__submit-btn">Send Message</button>
</form>
    <div class="contact__image">
      <img src="assets/img/build.jpg" alt="Contact Image">
    </div>
  </div>
</section>
   </main>
    
   <!--==================== FOOTER ====================-->
   <footer class="footer">
  <div class="footer__container container">
    <div class="footer__brand">
      <a href="#" class="footer__logo">
        <i class="ri-building-line"></i> Brik
      </a>
      <p class="footer__desc">
        Building dreams, one Brik at a time.<br>
        Tirana, Albania
      </p>
    </div>
    <div class="footer__links">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#about">About us</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#projects">Projects</a></li>
        <li><a href="#contact">Contact us</a></li>
      </ul>
    </div>
    <div class="footer__contact">
      <h4>Contact</h4>
      <ul>
        <li><i class="ri-map-pin-2-line"></i> Tirana, Albania</li>
        <li><i class="ri-phone-line"></i> <a href="tel:+355661234567">+355 66 123 4567</a></li>
        <li><i class="ri-mail-unread-line"></i> <a href="mailto:info@brik.com">info@brik.com</a></li>
      </ul>
      <div class="footer__social">
        <a href="#" title="Facebook"><i class="ri-facebook-fill"></i></a>
        <a href="#" title="Instagram"><i class="ri-instagram-line"></i></a>
        <a href="#" title="LinkedIn"><i class="ri-linkedin-fill"></i></a>
      </div>
    </div>
  </div>
  <div class="footer__bottom">
    <p>&copy; 2025 Brik. All rights reserved.</p>
  </div>
</footer>
  <!--==================== SCROLL UP ====================-->
  <a href="#" class="scrollup" id="scroll-up">
    <i class="ri-arrow-up-line"></i>
  </a>
   <!--=============== SCROLL REVEAL ===============-->
   <script src="assets/scrollreveal.min.js"></script>
   <!--=============== swiper js ===============-->
   <script src="assets/swiper-bundle.min.js"></script>

   <!--=============== MAIN JS ===============-->
   <script src="assets/main.js"></script>
</body>
</html>