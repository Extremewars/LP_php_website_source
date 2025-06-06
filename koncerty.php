<?php
include_once 'startup.php';
displayhead($status);
?>
<section>
    <br>
    <div class="container px-4 px-lg-5 text-background">
        <div class="row gx-4 gx-lg-5">
            <h1 class="centered">Koncert w Tuttlingen z 2017</h1>
            <div class="col-lg-6 centered">
                <iframe width="560" height="315"
                    src="https://www.youtube-nocookie.com/embed/PoX7C6cwNtY?si=dfri0-yZIijqqmdr"
                    title="YouTube video player"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="col-lg-6 centered">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5341.816783123699!2d8.902081717429935!3d47.97682945626724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x479a6e00ad9473e9%3A0x6c5d958f0b5001aa!2sSouthside%20Festival!5e0!3m2!1spl!2spl!4v1717925824219!5m2!1spl!2spl"
                    width="600" height="315" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="row gx-4 gx-lg-5">
            <h1 class="centered">Koncert w Lizbonie z 2012</h1>
            <div class="col-lg-6 centered">
                <iframe width="560" height="315"
                    src="https://www.youtube-nocookie.com/embed/C1Q-Ac4FFE8?si=yDSFrEljJAekZ3bt"
                    title="YouTube video player"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="col-lg-6 centered">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3811.0956823226593!2d-9.146551157663177!3d38.70623422951046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd19347d9df0b943%3A0xba642593c43f0ba!2sLisboa%20Rio!5e0!3m2!1spl!2spl!4v1717879057778!5m2!1spl!2spl"
                    width="600" height="315" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="row gx-4 gx-lg-5">
            <h1 class="centered">Koncert w Nowym Jorku z 2011</h1>
            <div class="col-lg-6 centered">
                <iframe width="560" height="315"
                    src="https://www.youtube-nocookie.com/embed/D3jleuDxThk?si=K_hMF3J886UbGaX2"
                    title="YouTube video player"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="col-lg-6 centered">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.5237225714!2d-73.99601898746938!3d40.750504471268584!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a21fb011c85%3A0x33df10e49762f8e4!2sMadison%20Square%20Garden!5e0!3m2!1spl!2spl!4v1717954434757!5m2!1spl!2spl"
                    width="600" height="315" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="row gx-4 gx-lg-5 centered">
            <h1 class="centered">Sprawdź swoją lokalizację</h1>
            <div class="col-lg-2 centered">
                <button class="form-button" onclick="pobierzLokalizacje()">Udostępnij swoją lokalizację</button>
            </div>
            <div class="col-lg-4 centered">
                <div id="pogoda"></div>
                <img id="ikona" src="assets/info.png" alt="Załaduj pogodę przyciskiem">
            </div>
            <div class="col-lg-6 centered">
                <div id="mapa"></div>
            </div>
        </div>

    </div>
</section>
<!-- JS Bootstrap'a-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Reszta plików JS-->
<script src="js/scripts.js"></script>
<script src="https://maps.google.com/maps/api/js?sensor=false"></script>
</body>

</html>