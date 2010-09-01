<?php foreach ( $this->configuration->getValue( 'list.display' ) as $name => $field ): ?>
[?php slot( 'sf_admin.current_header' ) ?]
<th class="sf_admin_thdr sf_admin_<?php echo strtolower( $field->getType() ) ?> sf_admin_list_th_<?php echo $name ?>">
<?php $rules = $this->configuration->getSortRules() ?>
<?php if ( $field->isReal() || isset( $rules[$name] ) ): ?>
    [?php if ( '<?php echo $name ?>' == $sort[0] ): ?]
        [?php echo Url::link( I18n::__( '<?php echo $this->getI18nCatalogue() ?>.<?php echo $field->getConfig( 'label', '', true ) ?>' ), '@<?php echo $this->getUrlForAction( 'list' ) ?>', array( 'query_string' => 'sort=<?php echo $name ?>&sort_type=' . ( $sort[1] == 'asc' ? 'desc' : ( $sort[1] == 'desc' ? 'def' : 'asc' ) ), 'ajax' => 'action', 'class' => 'sf_h_sort_' . ( $sort[1] == 'asc' ? 'asc' : ( $sort[1] == 'desc' ? 'desc' : 'def' ) ) ) ) ?]
    [?php else: ?]
        [?php echo Url::link( I18n::__( '<?php echo $this->getI18nCatalogue() ?>.<?php echo $field->getConfig( 'label', '', true ) ?>' ), '@<?php echo $this->getUrlForAction( 'list' ) ?>', array( 'query_string' => 'sort=<?php echo $name ?>&sort_type=asc', 'ajax' => 'action', 'class' => 'sf_h_sort_def' ) ) ?]
    [?php endif ?]
<?php else: ?>
    [?php echo I18n::__( '<?php echo $this->getI18nCatalogue() ?>.<?php echo $field->getConfig( 'label', '', true ) ?>' ) ?]
<?php endif ?>
</th>
[?php end_slot() ?]
<?php echo $this->addCredentialCondition( "[?php include_slot('sf_admin.current_header') ?]", $field->getConfig() ) ?>
<?php endforeach ?>
<script type="text/javascript">
$(function(){$('.sf_admin_thdr a.sf_h_sort_def').button({icons:{secondary:'ui-icon-triangle-2-n-s'}})});
$(function(){$('.sf_admin_thdr a.sf_h_sort_asc').button({icons:{secondary:'ui-icon-circle-triangle-s'}})});
$(function(){$('.sf_admin_thdr a.sf_h_sort_desc').button({icons:{secondary:'ui-icon-circle-triangle-n'}})});
</script>