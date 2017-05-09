<?php

namespace WPGSecurity;

/**
 * Class Module
 * @package WPGSecurity
 */
abstract class Module {

	/**
	 * @var \ReflectionObject|null
	 */
	private $_reflection = null;

	/**
	 * @var \WPGSecurity\DocBlock|null
	 */
	private $_doc = null;

	/**
	 * Return default setting for module.
	 * @return array
	 */
	public function getDefaultSettings() {
		return [];
	}

	/**
	 * Return module ID from module file name.
	 * @return string
	 */
	public abstract function getId();

	/**
	 * Return module name.
	 * @return string
	 */
	public function getName() {
		return $this->getDoc()->name ?: 'Undefined' ;
	}

	/**
	 * Get module Reflection object.
	 * @return \ReflectionObject
	 */
	public function getReflection() {
		if( $this->_reflection === null ) {
			$this->_reflection = new \ReflectionObject( $this );
		}
		return $this->_reflection;
	}

	/**
	 * Return Php Doc info.
	 * @return DocBlock
	 */
	public function getDoc() {
		if( $this->_doc === null ) {
			$this->_doc = new DocBlock( $this->getReflection()->getDocComment() );
		}
		return $this->_doc;
	}

	/**
	 * Return description parsed with Markdown.
	 * @return string HTML
	 */
	public function getDescription() {
		require_once 'vendors/Parsedown.php';
		$parser = new \Parsedown();
		$parser->setBreaksEnabled( true );
		return $parser->text( $this->_doc->description );
	}

	/**
	 * Protect site
	 *
	 * @param $data
	 * @return void
	 */
	public abstract function protect( $data );

}

interface RunOnAdmin {

	/**
	 * Protect admin.
	 *
	 * @param $data
	 * @return mixed
	 */
	public function protectAdmin( $data );

};

interface ModuleSettings {

	/**
	 * Return settings HTML for module.
	 * @param mixed $data Data from database.
	 * @return mixed
	 */
	public function settingsView( $data );
}

/**
 * This interface run only for settings data.
 *
 * @package WPGSecurity
 */
interface DataModify {

	/**
	 * Filter data before save in database.
	 *
	 * @param $data
	 * @return mixed
	 */
	public function beforeSave( $data );

	/**
	 * Filter data after load from database.
	 *
	 * @param $data
	 * @return mixed
	 */
	public function afterLoad( $data );

}