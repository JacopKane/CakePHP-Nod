<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('NodAppModel', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class NodAppModel extends Model {
	protected function _formatName($firstName = '', $lastName = '') {
		$firstName = trim($firstName);
		$lastName = trim($lastName);
		return "{$firstName} {$lastName}";
	}

	protected function _formatPassword($password = '') {
		return AuthComponent::password($password);
	}

	public function beforeSave($options = array()) {
		$parent = parent::beforeSave($options);

		if(empty($this->data[$this->alias]['name']))
			return $parent;

		$name			= $this->data[$this->alias]['name'];
		$name_slug		= strtolower(Inflector::slug($name));
		$name_variable	= Inflector::variable($name_slug);

		$this->data[$this->alias] += compact('name_variable', 'name_slug');

		return $parent;
	}
}
