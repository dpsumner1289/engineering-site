<?php
global $flex_content;
dlc($flex_content);
?>
<script>
    jQuery(document).ready(function($){
        $('section.dlc .gform_footer > .gform_button.button').addClass('<?php echo $flex_content['dlc_button_theme']; ?>');
    });
</script>