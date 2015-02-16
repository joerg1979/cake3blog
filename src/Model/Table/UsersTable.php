<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

/* 
 * The CakePHP Blog Tutorial on CakePHP3 RC2
 * From: CakePHP3Cookbook 
 * 
 * File: /src/Model/Table/UsersTable.php
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table {
    
    public function validationDefault(Validator $validator) {
        return $validator
                ->notEmpty('username', 'A username is required')
                ->notEmpty('password', 'A password is needed')
                ->notEmpty('role', 'A role is required')
                ->add('role', 'inList',[
                    'rule' => ['inList', ['admin', 'author']],
                    'message' => 'Please enter a valid role'
                ]);
    }
}