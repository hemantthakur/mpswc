<?php /* Smarty version 2.6.29, created on 2017-08-29 11:59:12
         compiled from themes%5CSuiteP%5Cinclude/SubPanel/tpls/SubPanelDynamic.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'counter', 'themes\\SuiteP\\include/SubPanel/tpls/SubPanelDynamic.tpl', 48, false),array('function', 'sugar_action_menu', 'themes\\SuiteP\\include/SubPanel/tpls/SubPanelDynamic.tpl', 91, false),array('modifier', 'count', 'themes\\SuiteP\\include/SubPanel/tpls/SubPanelDynamic.tpl', 90, false),)), $this); ?>
<table cellpadding="0" cellspacing="0" border="0" class="list view table-responsive subpanel-table" data-empty="<?php echo $this->_tpl_vars['APP']['MSG_LIST_VIEW_NO_RESULTS_BASIC']; ?>
" <?php echo 'data-breakpoints=\'{ "xs": 754, "sm": 750, "md": 768, "lg": 992}\''; ?>
>
    <thead>
        <tr class="footable-header">
            <?php echo smarty_function_counter(array('start' => 0,'name' => 'colCounter','print' => false,'assign' => 'colCounter'), $this);?>

            <th data-type="html"><!-- extra th for the plus button -->&nbsp;</th>
            <?php $_from = $this->_tpl_vars['HEADER_CELLS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['colHeader'] => $this->_tpl_vars['header']):
?>
                                <?php if ($this->_tpl_vars['colCounter'] <= 1): ?>
                    <?php ob_start(); ?>1<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('breakpoints', ob_get_contents());ob_end_clean(); ?>
                <?php endif; ?>

                <?php if ($this->_tpl_vars['colCounter'] >= 2 && $this->_tpl_vars['colCounter'] < 5): ?>
                    <?php ob_start(); ?>xs sm<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('breakpoints', ob_get_contents());ob_end_clean(); ?>
                <?php endif; ?>

                <?php if ($this->_tpl_vars['colCounter'] >= 5 && $this->_tpl_vars['colCounter']): ?>
                    <?php ob_start(); ?>xs sm md<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('breakpoints', ob_get_contents());ob_end_clean(); ?>
                <?php endif; ?>
                <th data-breakpoints="<?php if ($this->_tpl_vars['breakpoints'] != 1): ?><?php echo $this->_tpl_vars['breakpoints']; ?>
<?php endif; ?>" data-type="html"><?php echo $this->_tpl_vars['header']; ?>
</th>
                <?php echo smarty_function_counter(array('name' => 'colCounter','print' => false), $this);?>

            <?php endforeach; endif; unset($_from); ?>
            <th data-type="html"><!-- extra th for the button --></th>
        </tr>
                <?php echo $this->_tpl_vars['PAGINATION']; ?>

        <tr id="activities_search" class="pagination" style="display:none" colspan="0">
            <td align="right" colspan="0"></td>
        </tr>
    </thead>
    <tbody>
    <?php echo smarty_function_counter(array('start' => 0,'name' => 'rowCounter','print' => false,'assign' => 'rowCounter'), $this);?>

    <?php $_from = $this->_tpl_vars['ROWS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rowHeader'] => $this->_tpl_vars['row']):
?>
        <?php if ($this->_tpl_vars['rowCounter'] % 2 == 0): ?>
                        <?php $this->assign('rowClass', 'oddListRowS1'); ?>
        <?php else: ?>
                        <?php $this->assign('rowClass', 'evenListRowS1'); ?>
        <?php endif; ?>
        <tr class="<?php echo $this->_tpl_vars['rowClass']; ?>
" >
            <td>&nbsp;</td>
            <?php $_from = $this->_tpl_vars['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['colHeader'] => $this->_tpl_vars['cell']):
?>
                <td><?php echo $this->_tpl_vars['cell']; ?>
</td>
            <?php endforeach; endif; unset($_from); ?>
            <td>
                <?php if (count($this->_tpl_vars['ROWS_BUTTONS'][$this->_tpl_vars['rowHeader']]) > 0): ?>
                    <?php echo smarty_function_sugar_action_menu(array('id' => ($this->_tpl_vars['rowHeader']),'buttons' => $this->_tpl_vars['ROWS_BUTTONS'][$this->_tpl_vars['rowHeader']],'class' => "",'flat' => false), $this);?>

                <?php endif; ?>
            </td>
        </tr>
        <?php echo smarty_function_counter(array('name' => 'rowCounter','print' => false), $this);?>

    <?php endforeach; endif; unset($_from); ?>
    </tbody>
</table>