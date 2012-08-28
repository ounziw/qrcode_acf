<?php 

class TestQr extends PHPUnit_Framework_TestCase {

	protected $mydata ;
	protected $mymetakey = 'acf-testkey';

	function setUp() {
		$this->mydata = new QRCode_field(new Acf());
	}
	function test_insert() {

		$field = array(
		//'default_value' => 'http://www.example.com/',
		'name' => $this->mymetakey,
		'key' => $this->mymetakey,
		);
		$this->mydata->update_value(1,$field,'http://example.com/');

		$result = $this->mydata->get_value_for_api(1,$field);
		$expected = '<img class="qrcode_acf" src="http://api.qrserver.com/v1/create-qr-code/?size=150x150&amp;ecc=L&amp;data=http%3A%2F%2Fexample.com%2F">';
		$this->assertEquals($expected, $result);
	}

	function test_default() {
		$field = array(
		'default_value' => 'http://example.com/',
		'size' => 100,
		'name' => 'acf-test',
		);

		$result = $this->mydata->get_value_for_api(0,$field);
		$expected = '<img class="qrcode_acf" src="http://api.qrserver.com/v1/create-qr-code/?size=100x100&amp;ecc=L&amp;data=http%3A%2F%2Fexample.com%2F">';
		$this->assertEquals($expected, $result);
	}

	function tearDown() {
		delete_post_meta(1,$this->mymetakey);
		delete_post_meta(1,'_' . $this->mymetakey);
	}
}
