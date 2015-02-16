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
 * File: /src/Controller/CategoriesController.php
 */
namespace App\Controller;

use Cake\Network\Exception\NotFoundException;

class CategoriesController extends AppController{
    
    public function index(){
        $categories = $this->Categories->find('threaded')
                ->order(['lft' => 'asc']);
        $this->set(compact('categories'));
    }
    
    public function view($id = NULL){
        if (!$id) {
            throw new NotFoundException(__('Invalid category'));
        }
        $category = $this->Categories->get($id);
        $this->set(compact('category'));
    }
    public function add(){
        $category = $this->Categories->newEntity($this->request->data);
        if($this->request->is('post')){
            if($this->Categories->save($category)){
                $this->Flash->success(__('The category has been saved'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add category!'));
        }
        $this->set('category', $category);
    }   
    
    public function edit($id = NULL){
        if(!$id){
            throw new NotFoundException(__('Invalid Category')); 
        }
        $category = $this->Categories->get($id);
        if($this->request->is('post', 'put')){
            $this->Categories->patchEntity($category, $this->request->data);
            if($this->Categories->save($category)){
                $this->Flash->success(__('Your category has been updated'));
                return $this->redirect(['action','index']);
            }
            $this->Flash->error(__('Unable to update your category'));
        }
        $this->set('category', $category);
    }
    
    public function delete($id){
        $this->request->allowMethod(['post','delete']);
        
        if(!$id){
            throw new NotFoundException(__('Ivalid category'));
        }
        
        $category = $this->Categories->get($id);
        if($this->Categories->delete($category)){
            $this->Flash->success(__(
                    'The category with ID:{0} has been deleted',
                    h($id)));
        
            return $this->redirect(['action' =>'index']);  
        }
    }
    
    public function move_up($id = NULL){
        $this->request->allowMethod(['post','put']);
        $category = $this->Categories->get($id);
        
        if($this->Categories->moveUp($category)){
            $this->Flash->success(__('Category has been moved Up'));
        } else {
            $this->Flash->error(__('The category could not be moved up!'));
        }
        return $this->redirect($this->referer(['action'=>'index']));
    }
    
    public function move_down($id = NULL){
        $this->request->allowMethod(['post','put']);
        $category = $this->Categories->get($id);
        if($this->Categories->moveDown($category)){
            $this->Flash->success(__('Category has been moved down.'));
        } else {
            $this->Flash->error(__('Category could not been moved down!'));
        }
        return $this->redirect($this->referer(['action'=>'index']));
    }    
}
