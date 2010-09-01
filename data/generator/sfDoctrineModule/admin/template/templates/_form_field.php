[?php if ( $field->isPartial() ): ?]
    [?php echo Partial::get( '<?php echo $this->getModuleName() ?>/' . $name, array( 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes ) ) ?]
[?php elseif ( $field->isComponent() ): ?]
    [?php echo Partial::get( '<?php echo $this->getModuleName() ?>', $name, array( 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes ) ) ?]
[?php elseif ( $form[$name] instanceof sfFormFieldSchema ): ?]
    [?php $form[$name]->getWidget()->getFormFormatter()->setTranslationCatalogue( '<?php echo $this->getI18nCatalogue() ?>' ) ?]
    [?php foreach ( $form[$name] as $k => $v ): ?]
    [?php if ( !$v->isHidden() ) $v->getWidget()->setAttribute( 'class', 'text ui-widget-content ui-corner-all' ) ?]
    [?php endforeach ?]
    [?php UI::renderField( $form[$name], array( 'class' => 'text ui-widget-content ui-corner-all' ) ) ?]
[?php else: ?]
<div class="[?php echo $class ?][?php $form[$name]->hasError() and print ' errors' ?]">
    [?php echo $form[$name]->renderError() ?]
    <div>
        [?php echo $form[$name]->renderLabel( $label ) ?]

        [?php UI::renderField( $form[$name], array( 'class' => 'text ui-widget-content ui-corner-all' ) ) ?]

        [?php if ( $help ): ?]
        <div class="help">[?php echo I18n::__( '<?php echo $this->getI18nCatalogue() ?>.' . $help ) ?]</div>
        [?php elseif ( $help = $form[$name]->renderHelp() ): ?]
        <div class="help">[?php echo $help ?]</div>
        [?php endif; ?]
    </div>
</div>
[?php endif; ?]
