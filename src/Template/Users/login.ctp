<div class="users form">
    
    <?= $this->Flash->render('Auth') ?>
    <?= $this->Form->create()  ?> 
    <fieldset>
        <legend><?= __('Please enter username and password')  ?></legend>
    
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
    </fieldset>
    <?= $this->Form->button('Submit') ?>
    <?= $this->Form->end() ?>
</div>