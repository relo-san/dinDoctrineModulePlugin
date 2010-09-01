<?php $module = $this->getModuleName() ?>
<?php $sing = $this->getSingularName() ?>
<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all sf_admin_module_<?php echo $module ?>_form">
    <div class="fg-toolbar ui-widget-header ui-corner-all">
        <h1>[?php echo <?php echo $this->getI18NString( 'new.title' ) ?> ?]</h1>
    </div>

    [?php echo Partial::get( '<?php echo $module ?>/flashes') ?]

    <div id="sf_admin_header"></div>

    <div id="sf_admin_content">
        [?php echo Partial::get( '<?php echo $module ?>/form', array( '<?php echo $sing ?>' => $<?php echo $sing ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper ) ) ?]
    </div>

    <div id="sf_admin_footer"></div>
</div>
<script type="text/javascript">
if(typeof jQuery!='undefined'){$('#breadcrumbs').html(
<?php if ( $this->configuration->getParentLinks() ): ?>
<?php foreach( $this->configuration->getParentLinks() as $name => $link ): ?>
[?php $listUrl = Url::url( '<?php echo $link ?>' ) ?]
'&nbsp;/&nbsp;<strong><a onclick="actionAjax(\'actionPartial\',\'[?php echo $listUrl ?]\');return false;" href="[?php echo $listUrl ?]">[?php echo <?php echo $this->getI18NString( 'new.fields.' . $name . '.label' ) ?> ?]</a></strong>'+
<?php endforeach ?>
<?php endif ?>
[?php $listUrl = Url::url( $helper->getUrlForAction( 'list' ) ) ?]
'&nbsp;/&nbsp;<strong><a onclick="actionAjax(\'actionPartial\',\'[?php echo $listUrl ?]\');return false;" href="[?php echo $listUrl ?]">[?php echo <?php echo $this->getI18NString( 'list.title' ) ?> ?]</a></strong>&nbsp;/&nbsp;[?php echo <?php echo $this->getI18NString( 'new.title' ) ?> ?]');
}</script>