<?php /* Smarty version 2.6.29, created on 2017-08-29 12:03:38
         compiled from cache/include/InlineEditing/LeadsEditViewaccount_name.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['account_name']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['account_name']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['account_name']['value']); ?>
<?php endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['account_name']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['account_name']['name']; ?>
' size='30' 
    maxlength='255' 
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >