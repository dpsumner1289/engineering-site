<?php
if(! class_exists('bc_contact_Widget')) {

class bc_contact_Widget extends WP_Widget {
    public function __construct() {
        $options = array(
            'classname' => 'contact_widget',
            'description' =>  'Contact widget for sidebar placement',
        );
        parent::__construct('contact_widget', 'Contact Widget', $options);
    }

    public function widget($args, $instance) {
        $content = $instance['content'];
        $button = $instance['button'];
        $button_label = $instance['button_label'];

        echo $args['before_widget'] . $args['before_title'] . $args['after_title'];
        ?>
        <div class="contact-widget">
            <div class="content">
            <?php echo $content; ?>
            </div>
            <?php if(!empty($button_label) && !empty($button)){ echo '<a href="'.$button.'">'.$button_label.'</a>'; } ?>
        </div>
        <?php
        echo $args['after_widget'];
    }
    public function form($instance) {
        global $wp_customize;
        $instance = wp_parse_args( (array) $instance, array(
            'title' => '',
            'text'  => '',
            'type'  => 'visual',
        ) );
        if ( $wp_customize && ! defined( 'DOING_AJAX' ) ) {
            $instance['type'] = 'visual';
        }
    }
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        return $instance;
    }
}
}