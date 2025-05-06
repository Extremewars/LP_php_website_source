<?php
include_once 'startup.php';
displayhead($status);
?>
<div id="galeria">
  <br>
  <div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
        aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
        aria-label="Slide 4"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"
        aria-label="Slide 5"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="assets/img/koncerty/Linkin_Park_Tokyo_2006.jpg" class="d-block w-100" alt="Koncert w Tokyo (2006)">
        <div class="carousel-caption d-md-block">
          <h5>Koncert w Tokyo (2006)</h5>
        </div>
      </div>
      <div class="carousel-item">
        <img src="assets/img/koncerty/Linkin_Park_Mansfield_2007.jpg" class="d-block w-100"
          alt="Koncert w Mansfield (2007)">
        <div class="carousel-caption d-md-block">
          <h5>Koncert w Mansfield (2007)</h5>
        </div>
      </div>
      <div class="carousel-item">
        <img src="assets/img/koncerty/Linkin_Park_Prague_2007.jpg" class="d-block w-100" alt="Koncert w Pradze (2007)">
        <div class="carousel-caption d-md-block">
          <h5>Koncert w Pradze (2007)</h5>
        </div>
      </div>
      <div class="carousel-item">
        <img src="assets/img/koncerty/Linkin_Park_Berlin_2010.jpg" class="d-block w-100"
          alt="Koncert w Berlinie (2010)">
        <div class="carousel-caption d-md-block">
          <h5>Koncert w Berlinie (2010)</h5>
        </div>
      </div>
      <div class="carousel-item">
        <img src="assets/img/koncerty/Linkin_Park_Dortmund_2010.jpg" class="d-block w-100"
          alt="Koncert w Dortmund (2010)">
        <div class="carousel-caption d-md-block">
          <h5>Koncert w Dortmund (2010)</h5>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
      data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
      data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>
<!-- JS Bootstrap'a-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Reszta plików JS-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/scripts.js"></script>
<script src="js/lightbox.js"></script>
</body>

</html>