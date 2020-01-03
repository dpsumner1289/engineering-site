<?php
if(!function_exists('client_quote')) {
    function client_quote($postID) {
        ?>
        <section class="mixed_content flex col">
            <div class="flex row container container-lg jfc afc">
                <?php
                $wysiwyg = get_post_meta($postID, 'wysiwyg', true);
                $wysiwyg = apply_filters('the_content', $wysiwyg);
                $label = get_post_meta($postID, 'button_label', true);
                $link = get_post_meta($postID, 'button_link', true);
                $theme = get_post_meta($postID, 'button_theme', true);
                ?>
                <div class="content_col item_1_2 wysiwyg large_headings flex col afs">
                    <?php if(!empty($wysiwyg)){echo '<div class="wizzy">'.$wysiwyg.'</div>';} ?>
                    <?php if(!empty($link) && !empty($label)){echo '<a class="button '.$theme.'" href="'.$link.'">'.$label.'</a>';} ?>
                </div>
                <?php
                $quote_content = get_post_meta($postID, 'quote', true);
                $author = get_post_meta($postID, 'author', true);
                $author_title = get_post_meta($postID, 'author_title', true);
                $button_link = get_post_meta($postID, 'button_link_right', true);
                $button_label = get_post_meta($postID, 'button_label_right', true);
                ?>
                <div class="content_col item_1_2 quote flex col">
                    <div class="quote_content"><?php echo $quote_content; ?></div>
                    <div class="quote_meta">
                        <div class="author"><?php echo $author; ?></div>
                        <div class="author_title"><?php echo $author_title; ?></div>
                    </div>
                    <?php
                    if(!empty($button_label) && !empty($button_link)):
                    ?>
                    <a href="<?php echo $button_link; ?>" class="seemore"><?php echo $button_label; ?> <i class="fal fa-arrow-right"></i></a>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
}