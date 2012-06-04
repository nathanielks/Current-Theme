<div class="wrapper">
	<fieldset>
		<legend>
			<?php _e('Popular Posts Options', self::locale); ?>
		</legend>
		<div class="option">
			<label for="title">
				<?php _e('Title', self::locale); ?>
			</label>
			<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="" />
		</div>
		<div class="option">
			<label for="number_of_posts">
				<?php _e('Number of Posts to Display', self::locale); ?>
			</label>
		<input type="text" id="<?php echo $this->get_field_id('number_of_posts'); ?>" name="<?php echo $this->get_field_name('number_of_posts'); ?>" value="<?php echo $instance['number_of_posts']; ?>" class="" />
		</div>
	</fieldset>
</div><!-- /wrapper -->
