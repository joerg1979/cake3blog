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
 * File: /src/Template/Users/add.ctp
 */ 
?>
<div class="users form">
<?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?= $this->Form->input('username')  ?>
        <?= $this->Form->input('password')  ?>
        <?= $this->Form->input('role',[
            'options' => ['admin' => 'Admin', 'author' => 'Author']]) ?>
    </fieldset>
        <?= $this->Form->button(__('Submit'))  ?>
        <?= $this->Form->end() ?>
</div>