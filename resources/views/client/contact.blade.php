@include('layouts.headclient')

  <!-- ***** Breadcrumb Area Start ***** -->
  <div class="breadcumb-area bg-img bg-gradient-overlay" style="background-image: url(img/bg-img/12.jpg);">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <h2 class="title">Contactanos</h2>
        </div>
      </div>
    </div>
  </div>
  <div class="breadcumb--con">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Contactanos</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- ***** Breadcrumb Area End ***** -->

  <!-- ***** Contact Area Start ***** -->
  <section class="dento-contact-area mt-50 mb-100">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="google-maps mb-100">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d819.9300862403422!2d-76.96369803075828!3d-12.162232509675468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105b8f80bfb2233%3A0x9ecd161f208e444a!2sCoes!5e0!3m2!1ses-419!2spe!4v1626596777380!5m2!1ses-419!2spe"
              allowfullscreen></iframe>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Contact Information -->
        <div class="col-12 col-md-4">
          <div class="contact-information">
            <h5>Dirección</h5>
            <p>Avenida Andrés Guzmán, 720 San Juan De Miraflores, Cercado de Lima 15801</p>

            <h5>Número</h5>
            <p>+84. 2252. 2250. 122</p>

            <h5>Email</h5>
            <p class="mb-0">info.dento@gmail.com</p>
          </div>
        </div>

        <!-- Contact Form -->
        <div class="col-12 col-md-8">
          <div class="contact-form">
            <!-- Section Heading -->
            <div class="section-heading">
              <h2>Ponerse en contacto</h2>
              <div class="line"></div>
            </div>
            <!-- Form -->
            <form action="#" method="post">
              <div class="row">
                <div class="col-lg-6">
                  <input type="text" name="message-name" class="form-control mb-30" placeholder="Nombre completo">
                </div>
                <div class="col-lg-6">
                  <input type="email" name="message-email" class="form-control mb-30" placeholder="Correo">
                </div>
                <div class="col-12">
                  <textarea name="message" class="form-control mb-30" placeholder="Su mensaje"></textarea>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn dento-btn">Enviar mensaje</button>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ***** Contact Area End ***** -->

 @include('layouts.footerclient')