<?php
    //Titles
    class Restrotica_Lite_Section_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
            <h3><?php echo '<strong>'. esc_html( $this->label ) . '</strong>'; ?></h3>
        <?php
        }
    }

