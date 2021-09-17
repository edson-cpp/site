<?php
class wpcu3er_widget extends WP_Widget {
	function wpcu3er_widget() {
		// widget actual processes
		parent::WP_Widget(false, $name = __('CU3ER'), array(
			'description' => __('Add CU3ER project to your widgets area')
		));
	}
 
	function widget($args, $instance) {
		global $wpdb;
		extract( $args );
		extract( $instance );
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		echo $before_widget;
		if(!empty($title)) {
			echo $before_title . $title . $after_title;
		};
		display_cu3er($instance['cu3er']);
		// content of our widget //
		echo $after_widget;
	}
 
	function update($new_instance, $old_instance) {
		// processes widget options to be saved
		return $new_instance;
	}
 
	function form($instance) {
		extract($instance);
		global $wpdb;
		$rnd = mt_rand();
		?>
		<p>
			<h4><span><?php _e('CU3ER Project'); ?></span></h4>
			<div class="transHalf noBorder" id="placeholders<?php echo $rnd; ?>">
				<div class="inputs">
					<label for="<?php echo $this->get_field_id('cu3er'); ?>"><?php echo __('CU3ER'); ?>
					<select name="<?php echo $this->get_field_name('cu3er'); ?>" id="<?php echo $this->get_field_id('cu3er'); ?>" style="max-width:180px;">
						<?php $loop = mysql_query("SELECT `id`,`name` FROM `" . $wpdb->prefix . "cu3er__slideshows`");
						while($row = mysql_fetch_assoc($loop)): ?>
							<?php if($row['id'] == $cu3er): ?>
								<option value="<?php echo $row['id'] ?>" selected="selected"><?php echo $row['name'] ?></option>
							<?php else: ?>
								<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
							<?php endif; ?>
						<?php endwhile; ?>
					</select>
				</div>
			</div>
		</p>
	<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("wpcu3er_widget");'));
?>