<?php if ( $sf_context->getModuleName() != 'auth' ): ?>
<div id="sf_admin_menu" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
    <?php include_partial( 'dinAdminDashboard/menu', array( 'categories' => $categories ) ) ?>
    <?php if ( $sf_user->isAuthenticated() ): ?>
        <div id="logout">
            [<?php echo Url::link( I18n::__( 'messages.labels.logout' ), '@logout', array( 'ajax' => 'action', 'dest' => 'logout' ) ) ?>]
            <?php echo $sf_user->getNickname() ?>
        </div>
    <?php endif ?>
    <div class="clear"></div>
</div>
<?php if ( sfConfig::get( 'app_admin_include_path', true ) ): ?>
<div id="sf_admin_path" class="ui-widget">
    <strong><?php echo Url::link( I18n::__( 'messages.labels.home' ), '@homepage' ) ?></strong>
    <div id="breadcrumbs"></div>
</div>
<?php endif ?>
<?php endif ?>