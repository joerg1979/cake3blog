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
 * File: /src/Controller/ArticlesController.php
 */
namespace App\Controller;

use Cake\Network\Exception\NotFoundException;

class ArticlesController extends AppController {

    public function index() {
        $articles = $this->Articles->find('all');
        $this->set(compact('articles'));
    }
    
    public function view($id = null){
        if (!$id){
            throw new NotFoundException(__('Ivalid atricle'));
        }
        $article = $this->Articles->get($id);
        $this->set(compact('article'));
    }
    
    public function add() {
        $article = $this->Articles->newEntity($this->request->data);
        if($this->request->is('post')){
            if($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article!'));
        }
        $this->set('article', $article);
    }
    
    public function edit($id = NULL){
        if(!$id){
            throw new NotFoundException(__('Invalid article'));
        }
        
        $article = $this->Articles->get($id);
        
        if($this->request->is(['post', 'put'])){
            $this->Articles->patchEntity($article, $this->request->data);
            if($this->Articles->save($article)){
                $this->Flash->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unabke to update your article.'));
        }
        $this->set('article', $article);
    }
    
    public function delete($id){
        $this->request->allowMethod(['post', 'delete']);
        
        if(!$id){
            throw new NotFoundException(__('Invalid article'));
        }
        
        $article = $this->Articles->get($id);
        if($this->Articles->delete($article)){
            $this->Flash->success(__('The article with ID:{0} has been deleted', 
                              h($id)));
         return $this->redirect(['action' => 'index']);
        }
        
    }
}
