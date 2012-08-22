<?php

class QRCode_field extends acf_Field
{

	function __construct($parent)
	{
		// do not delete!
		parent::__construct($parent);

		// set name / title
		$this->name = 'QRCode'; // variable name (no spaces / special characters / etc)
		$this->title = __("QR Code",'acf'); // field label (Displayed in edit screens)

	}

	function create_options($key, $field)
	{
		$field['size'] = isset($field['size']) ? (int) $field['size'] : 150;
?>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e("size",'acf'); ?></label>
				<p class="description"><?php _e("size should be positive",'acf'); ?></p>
			</td>
			<td>
<?php 
		$this->parent->create_field(array(
			'type'	=>	'number',
			'name'	=>	'fields['.$key.'][size]',
			'value'	=>	$field['size'],
		));
?>
			</td>
		</tr>
<?php 
	}

	function create_field($field)
	{
		echo '<input type="text" value="' . $field['value'] . '" id="' . $field['name'] . '" class="' . $field['class'] . '" name="' . $field['name'] . '" />';
	}

	function get_value_for_api($post_id, $field)
	{
		$value = parent::get_value($post_id, $field);
		$value = filter_var($value,FILTER_SANITIZE_URL);
		$value = rawurlencode($value);
		$size = isset($field['size']) ? (int) $field['size'] : 150;
		$errorlv = apply_filters('qrcode_acf_errorlv','L');
		
		$format = '<img class="qrcode_acf" src="http://api.qrserver.com/v1/create-qr-code/?size=%1$dx%1$d&amp;ecc=%2$s&amp;data=%3$s">';
        $imgdata = sprintf($format, $size, $errorlv, $value);
        return $imgdata;
	}
}
