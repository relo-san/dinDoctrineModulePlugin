<?php /* $module = $this->getModuleName() ?>
<?php $sing = $this->getSingularName() ?>
<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
    <div class="fg-toolbar ui-widget-header ui-corner-all">
        [?php echo <?php echo $this->getI18NString( 'show.title' ) ?> ?]
    </div>

    <div class="sf_admin_actions_block ui-widget">
        [?php echo Partial::get( '<?php echo $module ?>/show_actions', array( '<?php echo $sing ?>' => $<?php echo $sing ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper ) ) ?]
    </div>

    <div class="ui-helper-clearfix"></div>

    [?php echo Partial::get( '<?php echo $module ?>/show', array( '<?php echo $sing ?>' => $<?php echo $sing ?>, 'form' => $form, 'configuration' => $configuration ) ) ?]
</div>
<?php */ ?>