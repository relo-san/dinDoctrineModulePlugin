<?php $module = $this->getModuleName() ?>
<?php $sing = $this->getSingularName() ?>
<div class="sf_admin_form">
    [?php $actionUrl = Url::urlf( $form, '@<?php echo $this->params['route_prefix'] ?>' ) ?]
    <script language="Javascript">
    $(document).ready(function(){formAjax('actionPartial','<?php echo $module ?>ActionForm','[?php echo $actionUrl ?]')});
    </script>
    <form action="[?php echo $actionUrl ?]" method="post" id="<?php echo $module ?>ActionForm">
    [?php if ( !$form->isNew() ): ?]<input type="hidden" name="sf_method" value="put" />[?php endif ?]

    <div class="sf_admin_actions_block ui-widget">
        [?php echo Partial::get( '<?php echo $module ?>/form_actions', array( '<?php echo $sing ?>' => $<?php echo $sing ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper ) ) ?]
    </div>


        [?php echo $form->renderHiddenFields( false ) ?]

        [?php if ( $form->hasGlobalErrors() ): ?]
            [?php echo $form->renderGlobalErrors() ?]
        [?php endif ?]

        [?php $fieldsets = $configuration->getFormFields( $form, $form->isNew() ? 'new' : 'edit' ) ?]

        <script type="text/javascript">
        if(typeof jQuery!='undefined'){$(function(){$('#sf_admin_form_tab_menu').tabs({});});}
        </script>
        <div id="sf_admin_form_tab_menu">
            [?php if ( count( $fieldsets ) > 1 ): ?]
            <ul>
                [?php foreach ( $fieldsets as $fieldset => $fields ): ?]
                <li><a href="#sf_fieldset_[?php echo preg_replace( '/[^a-z0-9_]/', '_', strtolower( $fieldset ) ) ?]" onclick="blur()">[?php echo I18n::__( '<?php echo $this->getI18nCatalogue() ?>.' . $fieldset ) ?]</a></li>
                [?php endforeach ?]
            </ul>
            [?php endif ?]

            [?php foreach ( $fieldsets as $fieldset => $fields ): ?]
            [?php echo Partial::get( '<?php echo $module ?>/form_fieldset', array('<?php echo $sing ?>' => $<?php echo $sing ?>, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset, 'isOne' => ( count( $fieldsets ) < 2 ) ? true : false ) ) ?]
            [?php endforeach ?]
        </div>
        <div class="sf_admin_actions_block ui-widget">
            [?php echo Partial::get( '<?php echo $module ?>/form_actions', array('<?php echo $sing ?>' => $<?php echo $sing ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper ) ) ?]
        </div>
    </form>
</div>