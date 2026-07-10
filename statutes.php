<?php
include_once("includes/header.php");
include_once("includes/nav_base.php");
?>

<div class="bgimg_2 parallax">
    <div class="caption">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-9  col-md-7 col-lg-5 border text-center">
                <span class="capital">Statutes</span>
            </div>
        </div>
    </div>
</div>

<div class="text-block" id="statutes">
    <div class="row justify-content-center text-center">
        <div class="col-11 col-sm-9 col-md-7">
            <p>Here you can read the current statutes of the IJPA. The registered statutes are in Spanish, an English translation is available.</p>
            <div class="btn-group mb-3" role="group" aria-label="Statutes language">
                <button type="button" class="btn btn-dark statutes-language active" data-language="en">English</button>
                <button type="button" class="btn btn-dark statutes-language" data-language="es">Español</button>
            </div>
            <p>
                <a id="statutes_download" class="btn btn-dark btn-sm" href="documents/Statutes_English.pdf" download>Download PDF</a>
            </p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <iframe id="statutes_pdf" class="statutes-pdf border" src="documents/Statutes_English.pdf" title="Statutes"></iframe>
        </div>
    </div>
</div>

<?php include_once("includes/footer.php") ?>

<script>
var statutesFiles = {
    en: 'documents/Statutes_English.pdf',
    es: 'documents/Statutes_Spanish.pdf'
};
document.querySelectorAll('.statutes-language').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.statutes-language').forEach(function(b) {
            b.classList.remove('active');
        });
        this.classList.add('active');
        var file = statutesFiles[this.dataset.language];
        document.getElementById('statutes_pdf').src = file;
        document.getElementById('statutes_download').href = file;
    });
});
</script>
