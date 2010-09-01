<?php if ( $listActions = $this->configuration->getValue( 'list.batch_actions' ) ): ?>
<li class="sf_admin_batch_actions_choice">
    <select name="batch_action" class="text ui-widget-content ui-corner-all">
        <option value="">[?php echo I18n::__( 'admin.labels.chooseAction' ) ?]</option>
<?php foreach ( (array) $listActions as $action => $params ): ?>
    <?php echo $this->addCredentialCondition( '<option value="' . $action . '">[?php echo I18n::__( \'admin.labels.' . strtolower( substr( $params['label'], 0, 1 ) ) . substr( $params['label'], 1 ) . '\' ) ?]</option>', $params ) ?>

<?php endforeach ?>
    </select>
    [?php $form = new BaseForm(); if ( $form->isCSRFProtected() ): ?]
    <input type="hidden" name="[?php echo $form->getCSRFFieldName() ?]" value="[?php echo $form->getCSRFToken() ?]" />
    [?php endif; ?]
    <button type="submit">[?php echo I18n::__( 'admin.labels.go' ) ?]</button>
</li>
<script type="text/javascript">$(function(){$(".sf_admin_batch_actions_choice button").button({icons:{primary:'ui-icon-circle-triangle-e'}})});</script>
<?php endif ?>
