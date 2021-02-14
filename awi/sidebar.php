<?php
/* The template for the notes sidebar */
?>

<?php if ( is_active_sidebar('manifesto-notes')): ?>
<aside class="sidebar widget-area">
<?php dynamic_sidebar('manifesto-notes'); ?>
</aside>
<?php endif; ?>