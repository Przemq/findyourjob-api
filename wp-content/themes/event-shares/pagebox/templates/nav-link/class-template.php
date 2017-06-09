<?php

namespace Nurture\Template;

use Nurture\Pagebox\Template\SectionTemplate;

class NavLink extends SectionTemplate {

	/**
	 * @return array Template configuration.
	 */
	protected function config() {
		return [
			'title'       => 'Nav Link',
			'description' => 'Used for naw link'
		];
	}

	/**
	 * @return array Sections configuration.
	 */
	protected function sections() {
		return [
			'nav' => [ 'width' => 100, 'label' => 'Nav Link Container' ]
		];
	}
}