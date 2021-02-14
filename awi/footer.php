<?php 
/* main footer template */ ?>
<script>
    window.onload = function() { overlayFade() };
     window.onbeforeunload = function(){ everythingFade() };
     window.fitText( document.getElementById("site-title") );
    </script>
    <?php wp_footer(); ?>
</body>

</html>