<?php $module = $this->getModuleName() ?>
<div id="sf_admin_container" class="ui-widget sf_admin_module_<?php echo $module ?>_list">
    [?php echo Partial::get( '<?php echo $module ?>/flashes' ) ?]

<?php if ( $this->configuration->hasFilterForm() ): ?>
    <div id="sf_admin_bar" style="display:none;"></div>
<?php endif ?>

    <div id="sf_admin_content">
<?php if ( $this->configuration->getValue( 'list.batch_actions' ) ): ?>
    [?php $actionUrl = Url::urlr( '<?php echo $this->getUrlForAction( 'collection' ) ?>', array( 'action' => 'batch' ) ) ?]
    <script language="Javascript">
    $(document).ready(function(){formAjax('actionPartial','<?php echo $module ?>BatchForm','[?php echo $actionUrl ?]')});
    </script>
    <form action="[?php echo $actionUrl ?]" method="post" id="<?php echo $module ?>BatchForm">
<?php endif ?>

    <div class="sf_admin_actions_block ui-widget">
        [?php echo Partial::get( '<?php echo $module ?>/list_actions', array( 'helper' => $helper ) ) ?]
    </div>

    [?php echo Partial::get( '<?php echo $module ?>/list', array( 'pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'hasFilters' => $hasFilters ) ) ?]
    <ul class="sf_admin_actions sf_admin_batch_actions">
        [?php echo Partial::get( '<?php echo $module ?>/list_batch_actions', array( 'helper' => $helper ) ) ?]
    </ul>
<?php if ( $this->configuration->getValue( 'list.batch_actions' ) ): ?>
    </form>
<?php endif ?>
    </div>

</div>
<script type="text/javascript">
$('#breadcrumbs').html(
<?php if ( $this->configuration->getParentLinks() ): ?>
<?php foreach( $this->configuration->getParentLinks() as $name => $link ): ?>
[?php $listUrl = Url::url( '<?php echo $link ?>' ) ?]
'&nbsp;/&nbsp;<strong><a onclick="actionAjax(\'actionPartial\',\'[?php echo $listUrl ?]\');return false;" href="[?php echo $listUrl ?]">[?php echo <?php echo $this->getI18NString( 'list.fields.' . $name . '.label' ) ?> ?]</a></strong>'+
<?php endforeach ?>
<?php endif ?>
'&nbsp;/&nbsp;[?php echo <?php echo $this->getI18NString( 'list.title' ) ?> ?]');
</script>