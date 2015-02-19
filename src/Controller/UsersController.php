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
 * File: /src/Controller/UsersController.php
 */

namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\ForbiddenException;
use Cake\Event\Event;

class UsersController extends AppController{
    
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'logout']);
    }
    
    public function login(){
        if($this->request->is('post')){
            $user = $this->Auth->identify();
            if($user){
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }
    
    public function logout(){
        return $this->redirect($this->Auth->logout());
                
    }
    
    public function index(){
        $this->set('users', $this->Users->find('all'));
    }
    
    public function view($id){
        if(!$id){
            throw new NotFoundException(__('Invalid user'));
        }
        $users = $this->Users->get($id);
        $this->set(compact('user'));
    }
    
    public function add(){
        $user = $this->Users->newEntity($this->request->data);
        if($this->request->is('post')){
            if($this->Users->save($user)){
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('Unable to add this user'));
        }
        $this->set('user', $user);
    }
    
}