<div id="sf_fieldset_[?php echo preg_replace( '/[^a-z0-9_]/', '_', strtolower( $fieldset ) ) ?]"[?php echo $isOne ? ' class="sf_admin_form_tab_menu_fieldset_one"' : '' ?]>
<fieldset>
[?php foreach ( $fields as $name => $field ): ?]
    [?php if ( ( isset( $form[$name] ) && $form[$name]->isHidden() ) || ( !isset( $form[$name] ) && $field->isReal() ) ) continue ?]
    [?php echo Partial::get( '<?php echo $this->getModuleName() ?>/form_field', array(
        'name'          => $name,
        'attributes'    => $field->getConfig( 'attributes', array() ),
        'label'         => $field->getConfig( 'label' ),
        'help'          => $field->getConfig( 'help' ),
        'form'          => $form,
        'field'         => $field,
        'class'         => 'sf_admin_form_row sf_admin_' . strtolower( $field->getType() ) . ' sf_admin_form_field_' . $name,
    ) ) ?]
[?php endforeach; ?]
</fieldset>
</div>
