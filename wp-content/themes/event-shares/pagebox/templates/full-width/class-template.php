<?php

namespace Nurture\Template;

use Nurture\Pagebox\Template\SectionTemplate;

class FullWidth extends SectionTemplate {

	/**
	 * @return array Template configuration.
	 */
	protected function config() {
		return [
			'title'       => 'Full width',
			'description' => '100% width template'
		];
	}

	/**
	 * @return array Sections configuration.
	 */
	protected function sections() {
		return [
			'full' => [ 'width' => 100, 'label' => 'Fluid container' ]
		];
	}
}