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
    
    # indexingMethod shows all Articles found in db.articles
    public function index() {
        $articles = $this->Articles->find('all');
        $this->set(compact('articles'));
    }
    
    #viewMethod shows details of article-ID
    public function view($id = null){
        if (!$id){
            throw new NotFoundException(__('Ivalid atricle'));
        }
        $article = $this->Articles->get($id);
        $this->set(compact('article'));
    }
    
    # addingMethod tries to add/save a new article
    # on success showing Message and redirects to index-view of articles
    # error will throw NFException
    public function add() {
        $article = $this->Articles->newEntity($this->request->data);
        if($this->request->is('post')){
            $article->user_id = $this->Auth->user('id');
            
            $newData = ['user_id' => $this->Auth->user('id')];
            $article = $this->Articles->patchEntity($article, $newData);
            
            if($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article!'));
        }
        $this->set('article', $article);
        
        $categories = $this->Articles->Categories->find('treeList');
        $this->set(compact('categories'));
    }
    
    # editingMethod, without ID throw NFEception
    # at post&put-requests  tries to save, success will show Msg and redirect to index.
    # error while saving will throw NFException
    public function edit($id = NULL){
        if(!$id){
            throw new NotFoundException(__('Invalid article'));
        }
        
        $article = $this->Articles->get($id);
        
        if($this->request->is(['post', 'put'])){
            $this->Articles->patchEntity($article, $this->request->data); # using post-data to update article using patchEntityMethod
            if($this->Articles->save($article)){
                $this->Flash->success(__('Your article has been updated.')); #when saved, shows successMsg after redirecting to index
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.')); # shows errorMsg on saveFailure
        }
        $this->set('article', $article);
        
        $categories = $this->Articles->Categories->find('treeList');
        $this->set(compact('categories'));
    }
    
    # deletingMethod, only post&delete-requests will be allowed to go on
    # check for a valid ID, invalidíd will throw NFEception
    # delete success will show Msg and redirect to index
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

    public function isAuthorized($user){        
        if($this->request->action === 'add'){
            return TRUE;
        }
        if(in_array($this->request->action,['edit','delete'])){
            $articleId = (int)$this->request->params['pass'][0];
            if($this->Articles->isOwnedBy($articleId, $user['id'])){
                return TRUE;
            }
        }
        return parent::isAuthorized($user);
    }
}
