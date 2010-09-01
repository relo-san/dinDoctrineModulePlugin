[?php $actionUrl = Url::urlr( '<?php echo $this->getUrlForAction( 'collection' ) ?>', array( 'action' => 'filter' ) ) ?]
<script type="text/javascript">
$(document).ready(function(){formAjax('actionPartial','<?php echo $this->getModuleName() ?>FilterForm','[?php echo $actionUrl ?]')});
</script>
<div class="sf_admin_filter" id="sf_<?php echo $this->getModuleName() ?>_filter" title="[?php echo I18n::__( 'admin.labels.filter' ) ?]">
    [?php if ( $form->hasGlobalErrors() ): ?]
        [?php echo $form->renderGlobalErrors() ?]
    [?php endif ?]

    <form action="[?php echo $actionUrl ?]" method="post" id="<?php echo $this->getModuleName() ?>FilterForm">
    [?php echo $form->renderHiddenFields() ?]
    <fieldset>
    [?php foreach ( $configuration->getFormFilterFields( $form ) as $name => $field ): ?]
    [?php if ( ( isset( $form[$name] ) && $form[$name]->isHidden() ) || ( !isset( $form[$name] ) && $field->isReal() ) ) continue ?]
    [?php if ( $field->isPartial() ): ?]
        [?php echo Partial::get( '<?php echo $this->getModuleName() ?>/' . $name, array( 'type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes ) ) ?]
    [?php elseif ( $field->isComponent() ): ?]
        [?php echo Partial::component( '<?php echo $this->getModuleName() ?>', $name, array( 'type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes ) ) ?]
    [?php else: ?]
    <div class="sf-filter-field sf_admin_filter_field_[?php echo $name ?]">
        [?php $attributes = $field->getConfig( 'attributes', array() ) ?]
        [?php echo $form[$name]->renderLabel( $field->getConfig( 'label' ) ) ?]
        [?php echo $form[$name]->renderError() ?]
        [?php //echo $form[$name]->render( $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes ) ?]
        [?php UI::renderField( $form[$name], array( 'class' => 'text ui-widget-content ui-corner-all' ) ) ?]
        [?php if ( $help = $field->getConfig( 'help' ) || $help = $form[$name]->renderHelp() ): ?]
        <div class="help">[?php echo I18n::__( '<?php echo $this->getI18nCatalogue() ?>.' . $help ) ?]</div>
        [?php endif ?]
    </div>
    [?php endif ?]
    [?php endforeach ?]
    </fieldset>
    </form>
</div>
<script type="text/javascript">
/* <![CDATA[ */
$('#sf_<?php echo $this->getModuleName() ?>_filter').dialog({autoOpen:true,height:400,width:600,modal:true,buttons:{'[?php echo I18n::__( 'admin.labels.filterSubmit' ) ?]':function(){$('#<?php echo $this->getModuleName() ?>FilterForm').submit();},'[?php echo I18n::__( 'admin.labels.filterCancel' ) ?]':function(){$(this).dialog('destroy');$('#sf_<?php echo $this->getModuleName() ?>_filter').remove();}},close:function(){}});
$('#sf_<?php echo $this->getModuleName() ?>_filter').dialog('open');
$('div.sf-filter-empty input,div.sf-filter-empty label').removeClass('text ui-widget-content ui-corner-all');
/* ]]> */
</script>