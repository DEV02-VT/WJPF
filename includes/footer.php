<!--<footer class="footer">
    <div class="py-md-3 px-3 px-md-3 text-body-secondary ">
        <div class="row justify-content-center text-center">
            <div class="col-6  col-md-3 col-lg-3 justify-content-center text-center mt-3 mb-3">
                <div class="imprint"><a href="impressum.php">Impressum</a></div>
                <div class="imprint"><a href="datenschutz.php">Datenschutz</a></div>
            </div>
        </div>
    </div>
</footer>-->

<script src="js/jquery/3.7.1/jquery-3.7.1.js"></script>
<script src="js/bootstrap/5.3.1/bootstrap.bundle.min.js"></script>


<script>
    // Get the button
    let mybutton = document.getElementById("topBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>


</body>
</html>
