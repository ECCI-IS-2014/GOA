<?php

App::uses('View', 'View');
App::uses('StringFormatterHelper', 'View/Helper');

/**
 * ProductsController Test Case
 *
 */
class StringFormatterHelperTest extends CakeTestCase {

	public $helper = null;


	public function setUp() {
        parent::setUp();
        $view = new View();
        $this->helper = new StringFormatterHelper($view);
    }

	public function testFormatCurrency() {
		$this->assertEquals('$100.00', $this->helper->formatCurrency(100, '$'));
		$this->assertEquals('$50.89', $this->helper->formatCurrency(50.8901023, '$'));
		$this->assertEquals('$32,800.00', $this->helper->formatCurrency(32800, '$'));
		$this->assertEquals('$9,289,200.90', $this->helper->formatCurrency(9289200.9012, '$'));
	}

	public function testHideCardNumber() {
		$this->assertEquals('************1111', $this->helper->hideCardNumber('5555999977771111'));
		$this->assertEquals('************4444', $this->helper->hideCardNumber('5555222211114444'));
	}

	public function testFormatCardNumber() {
		$this->assertEquals('5555-9999-7777-1111', $this->helper->formatCardNumber('5555999977771111','-'));
		$this->assertEquals('5555 2222 1111 4444', $this->helper->formatCardNumber('5555222211114444',' '));
	}

	public function testFormatCardLastNumbers() {
		$this->assertEquals('1221', $this->helper->formatCardLastNumbers('5555999977771221'));
		$this->assertEquals('4443', $this->helper->formatCardLastNumbers('5555222211114443'));
	}

	public function testFormatDateMY() {
		$this->assertEquals('June 2014', $this->helper->formatDateMY('2014-06-07'));
		$this->assertEquals('January 2017', $this->helper->formatDateMY('2017-01-04'));
	}

	public function testFormatDateMDY() {
		$this->assertEquals('June 07, 2014', $this->helper->formatDateMDY('2014-06-07'));
		$this->assertEquals('January 04, 2017', $this->helper->formatDateMDY('2017-01-04'));
	}

	public function testFormatWeight() {
		$this->assertEquals('100.00 kg', $this->helper->formatWeight(100, 'kg'));
		$this->assertEquals('50.89 kg', $this->helper->formatWeight(50.89, 'kg'));
	}

	public function testFormatVolume() {
		$this->assertEquals('87.00 cm<sup>3</sup>', $this->helper->formatVolume(87, 'cm'));
		$this->assertEquals('50.89 cm<sup>3</sup>', $this->helper->formatVolume(50.89, 'cm'));
	}

}