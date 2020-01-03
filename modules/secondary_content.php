<?php
if(!function_exists('single_secondary_content')) {
    function single_secondary_content($post_ID) {
        $secondary_content = get_post_meta($post_ID, 'secondary_content', true);
        $secondary_content = apply_filters('the_content', $secondary_content);
        $related_articles_heading = get_post_meta($post_ID, 'related_articles_heading', true);
        $related_articles_articles = get_post_meta($post_ID, 'related_articles_articles', true);
        ?>
        <section class="secondary_content">
            <div class="container container-lg flex row afs jfe">
                <?php if(!empty($secondary_content)): ?>
                    <div class="item_2_3 content">
                        <?php echo $secondary_content; ?>
                    </div>
                <?php endif; ?>
                <?php if(!empty($related_articles_articles)): ?>
                    <div class="item_1_3 related_articles">
                        <?php if(!empty($related_articles_heading)){echo '<h3>'.$related_articles_heading.'</h3>';} ?>
                        <ul>
                        <?php foreach($related_articles_articles as $article) {
                            $article_title = get_the_title($article);
                            $article_link = get_the_permalink($article);
                            echo '<li><a href="'.$article_link.'">'.$article_title.'</a></li>';
                        } ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}