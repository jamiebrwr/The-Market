<?php

function ecpt_textarea_field_options($field) {

	if($field->rich_editor == 1) { $checked = 'checked="checked"'; } ?>
		<input type="checkbox" class="ecpt-checkbox" id="rich-editor" name="rich-editor" <?php if( ! empty( $checked ) ) { echo $checked; } ?>/>
		<p class="description"><?php _e('Enable the rich editor?', 'ecpt'); ?></p>
		<input type="hidden" id="rich-max" name="rich-max" value="<?php echo $field->max; ?>"/>
		<input type="hidden" id="field-options" name="field-options" value="<?php echo $field->options; ?>"/>
	<?php $checked = '';
}
add_action('ecpt_field_options_textarea', 'ecpt_textarea_field_options');

function ecpt_radio_field_options($field) { ?>
	<input type="text" id="field-options" name="field-options" value="<?php echo $field->options; ?>" class="ecpt-text no-float"/>
	<p class="description"><?php _e('Set the available field options here, each separated by a comma.', 'ecpt'); ?></p>
	<input type="hidden" id="rich-editor" name="rich-editor" value="<?php echo $field->rich_editor; ?>"/>
	<input type="hidden" id="field-max" name="field-max" value="<?php echo $field->max; ?>"/>
	<?php

}
add_action('ecpt_field_options_radio', 'ecpt_radio_field_options');

function ecpt_multicheck_field_options($field) { ?>
	<input type="text" id="field-options" name="field-options" value="<?php echo $field->options; ?>" class="ecpt-text no-float"/>
	<p class="description"><?php _e('Set the available field options here, each separated by a comma.', 'ecpt'); ?></p>
	<input type="hidden" id="rich-editor" name="rich-editor" value="<?php echo $field->rich_editor; ?>"/>
	<input type="hidden" id="field-max" name="field-max" value="<?php echo $field->max; ?>"/>
	<?php

}
add_action('ecpt_field_options_multicheck', 'ecpt_multicheck_field_options');

function ecpt_select_field_options($field) { ?>
	<input type="text" id="field-options" name="field-options" value="<?php echo $field->options; ?>" class="ecpt-text no-float"/>
	<p class="description"><?php _e('Set the available field options here, each separated by a comma.', 'ecpt'); ?></p>
	<input type="hidden" id="rich-editor" name="rich-editor" value="<?php echo $field->rich_editor; ?>"/>
	<input type="hidden" id="field-max" name="field-max" value="<?php echo $field->max; ?>"/>
	<?php

}
add_action('ecpt_field_options_select', 'ecpt_select_field_options');

function ecpt_slider_field_options($field) { ?>
	<input type="text" id="field-max" name="field-max" value="<?php echo $field->max; ?>" class="ecpt-text no-float"/>
	<p class="description"><?php _e('Enter the maximum value accepted here', 'ecpt'); ?></p>
	<input type="hidden" id="rich-editor" name="rich-editor" value="<?php echo $field->rich_editor; ?>"/>
	<input type="hidden" id="field-options" name="field-options" value="<?php echo $field->options; ?>"/>
	<?php
}
add_action('ecpt_field_options_slider', 'ecpt_slider_field_options');
