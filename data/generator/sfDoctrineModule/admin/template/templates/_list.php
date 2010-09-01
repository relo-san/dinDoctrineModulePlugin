<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
    <table class="ui-widget ui-widget-content list-table" cellpadding="0" cellspacing="0" border="0">
        <caption class="ui-widget-header ui-corner-top">
            <?php if ( $this->configuration->hasFilterForm() ): ?>
            <div id="sf_admin_filters_buttons" class="ui-state-default">
                [?php echo $helper->linkToFilters( array() ) ?]
                [?php echo $helper->linkToClearFilters( array( 'hasFilters' => $hasFilters ) ) ?]
            </div>
      <?php endif; ?>
            <h1>[?php echo <?php echo $this->getI18NString( 'list.title' ) ?> ?]</h1>
        </caption>
        <thead class="ui-widget-header">
            <tr>
<?php if ( $this->configuration->getValue( 'list.batch_actions' ) ): ?>
                <th id="sf_admin_list_batch_actions" class="ui-th-column"><input id="sf_admin_list_batch_checkbox" class="ui-widget-content" type="checkbox" onclick="checkAll();" /></th>
<?php endif ?>
          [?php echo Partial::get( '<?php echo $this->getModuleName() ?>/list_th_<?php echo $this->configuration->getValue( 'list.layout' ) ?>', array( 'sort' => $sort ) ) ?]
<?php if ( $this->configuration->getValue( 'list.object_actions' ) ): ?>
                <th id="sf_admin_list_th_actions" class="ui-th-column">[?php echo I18n::__( 'admin.labels.actions' ) ?]</th>
<?php endif ?>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th  style="margin:0;padding:0;border:0;" colspan="<?php echo count( $this->configuration->getValue( 'list.display' ) ) + ( $this->configuration->getValue( 'list.object_actions' ) ? 1 : 0 ) + ( $this->configuration->getValue( 'list.batch_actions' ) ? 1 : 0 ) ?>">
                    <div class="ui-widget-header ui-corner-bottom">
                        <div class="ui-th-column sf-list-foot">
                        [?php if ( $pager->haveToPaginate() ): ?]
                            [?php echo Partial::get( '<?php echo $this->getModuleName() ?>/pagination', array( 'pager' => $pager ) ) ?]
                        [?php endif ?]
                        </div>
                    </div>
                </th>
            </tr>
        </tfoot>
        <tbody>
        [?php if ( !$pager->getNbResults() ): ?]
        <tr class="sf_admin_row ui-widget-content"><td colspan="20" height="30" align="center">
            <p style="text-align:center">[?php echo I18n::__( 'admin.labels.noResult' ) ?]</p>
        </td></tr>
        [?php else: ?]
        [?php foreach ( $pager->getResults() as $i => $<?php echo $this->getSingularName() ?> ): $odd = fmod( ++$i, 2 ) ? 'odd' : 'even' ?]
            <tr class="sf_admin_row ui-widget-content [?php echo $odd ?]">
<?php if ( $this->configuration->getValue( 'list.batch_actions' ) ): ?>
                <td><input type="checkbox" name="ids[]" value="[?php echo $<?php echo $this->getSingularName() ?>->getPrimaryKey() ?]" class="sf_admin_batch_checkbox" /></td>
<?php endif; ?>

<?php if ( $this->configuration->getValue( 'list.layout' ) == 'tabular' ): ?>
<?php foreach ( $this->configuration->getValue( 'list.display' ) as $name => $field ): ?>
<?php echo $this->addCredentialCondition( sprintf( <<<EOF
<td class="sf_admin_%s sf_admin_list_td_%s">
  [?php echo %s ?]
</td>
EOF
, strtolower( $field->getType() ), $name, $this->renderField( $field ) ), $field->getConfig() ) ?>
<?php endforeach ?>
<?php else: ?>
<td colspan="<?php echo count( $this->configuration->getValue( 'list.display' ) ) ?>">
  [?php echo <?php echo $this->getI18NString( 'list.params' ) ?> ?]
</td>
<?php endif ?>

<?php if ( $this->configuration->getValue( 'list.object_actions' ) ): ?>
<td style="padding-right:5px">
    <ul class="sf_admin_td_actions">
<?php foreach ( $this->configuration->getValue( 'list.object_actions' ) as $name => $params ): ?>
<?php if ( '_delete' == $name ): ?>
        <?php echo $this->addCredentialCondition( '[?php echo $helper->linkToDelete( $' . $this->getSingularName() . ', ' . $this->asPhp( $params ) . ') ?]', $params ) ?>

<?php elseif ( '_edit' == $name ): ?>
        <?php echo $this->addCredentialCondition('[?php echo $helper->linkToEdit( $' . $this->getSingularName() . ', ' . $this->asPhp( $params ) . ') ?]', $params ) ?>

<?php else: ?>
        <li class="sf_admin_action_<?php echo $params['class_suffix'] ?>">
            <script type="text/javascript">$(function(){$(".sf_admin_action_<?php echo $params['class_suffix'] ?> a").button({icons:{primary:'ui-icon-<?php echo isset( $params['icon_class_suffix'] ) ? $params['icon_class_suffix'] : 'gear' ?>'}})});</script>
            <?php echo $this->addCredentialCondition( $this->getLinkToAction( $name, $params, true ), $params ) ?>
        </li>
<?php endif ?>
<?php endforeach ?>
    </ul>
</td>
<?php endif ?>

            </tr>
        [?php endforeach ?]
        [?php endif ?]
        </tbody>
    </table>
</div>
<div id="dialog-del-obj" style="display:none" title="[?php echo I18n::__( 'admin.label.deleteObjectConfirm' ) ?]">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>[?php echo I18n::__( 'admin.text.deleteObjectConfirm' ) ?]</p>
</div>

<script type="text/javascript">
function checkAll(){var boxes=document.getElementsByTagName('input');for(var index=0;index<boxes.length;index++){box=boxes[index];if(box.type=='checkbox'&&box.className=='sf_admin_batch_checkbox')box.checked=document.getElementById('sf_admin_list_batch_checkbox').checked}return true;}
$(document).ready(function(){
    $('.sf_admin_list table tbody tr').hover(function(){$(this).addClass('ui-state-hover');},function(){$(this).removeClass('ui-state-hover');}).click(function(e){$(this).toggleClass('ui-state-highlight');var chx=$(this).find('input:checkbox');if($(this).hasClass('ui-state-highlight'))$(chx).attr('checked','checked');else $(chx).removeAttr('checked');});
});

</script>
