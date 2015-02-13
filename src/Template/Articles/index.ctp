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
 * File: /src/Template/Articles/index.ctp
 */ 
?>
<h1>Blog articles</h1>
<p><?= $this->Html->link('Add article', ['action'=>'add']) ?></p>
<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Created</th>
        <th>Action</th>
    </tr>
    <?php foreach($articles as $article): ?>
    <tr>
        <td><?= $article->id ?></td>
        <td><?= 
        $this->Html->link($article->title,['action' => 'view', $article->id]) ?>
        </td>
        <td><?= $article->created->format(DATE_RFC850) ?></td>
        <td>
            <?= $this->Form->postLink(
                    'Delete',
                    ['action' => 'delete', $article->id],
                    ['confirm' => 'Delete article ID:' . $article->id.' Are you sure?']) ?>
            <?= $this->Html->link('Edit', ['action' => 'edit', $article->id]) ?></td>
    </tr>
    <?php endforeach; ?>
</table>