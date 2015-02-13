<?php
/* Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
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
 * File: /src/Template/Articles/add.ctp
 */ 
?>
<h1>Add article</h1>
<?php 
    echo $this->Form->create($article);
    echo $this->Form->input('title');
    echo $this->Form->input('body', ['rows' => '15']);
    echo $this->Form->button(__('Save article'));
    echo $this->Form->end();
            
?>