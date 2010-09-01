[?php
$first = ( $pager->getPage() * $pager->getMaxPerPage() - $pager->getMaxPerPage() + 1 );
$last = $first + $pager->getMaxPerPage() - 1;
?]
<script type="text/javascript">
$(function(){$(".sf_admin_pagination a.sf_pg_first").button({icons:{primary:'ui-icon-seek-first'},text:false})});
$(function(){$(".sf_admin_pagination a.sf_pg_prev").button({icons:{primary:'ui-icon-seek-prev'},text:false})});
$(function(){$(".sf_admin_pagination a.sf_pg_next").button({icons:{primary:'ui-icon-seek-next'},text:false})});
$(function(){$(".sf_admin_pagination a.sf_pg_last").button({icons:{primary:'ui-icon-seek-end'},text:false})});
</script>
<div class="sf_admin_pagination">
    <div class="pagebar">
        [?php $url = Url::url( '@<?php echo $this->getUrlForAction( 'list' ) ?>', true ) ?]
        [?php echo Url::link( I18n::__( 'admin.labels.firstPage' ), $url . '?page=1', array( 'class' => 'sf_pg_first' . ( $pager->getPage() == 1 ? ' ui-state-disabled' : '' ), 'ajax' => 'action' ) ) ?]
        [?php echo Url::link( I18n::__( 'admin.labels.prevPage' ), $url . '?page=' . $pager->getPreviousPage(), array( 'class' => 'sf_pg_prev' . ( $pager->getPage() == 1 ? ' ui-state-disabled' : '' ), 'ajax' => 'action' ) ) ?]
        <div class="current">
            <span>[?php echo I18n::__( 'admin.labels.currentPage' ) ?]</span>
            <input type="text" class="text ui-widget-content ui-corner-all" name="page" value="[?php echo $pager->getPage() ?]" maxlength="7" size="10" />
            <span>[?php echo I18n::__( 'admin.texts.pages', array( '%1%' => $pager->getLastPage() ) ) ?]</span>
        </div>
        [?php echo Url::link( I18n::__( 'admin.labels.lastPage' ), $url . '?page=' . $pager->getLastPage(), array( 'class' => 'sf_pg_last' . ( $pager->getPage() == $pager->getLastPage() ? ' ui-state-disabled' : '' ), 'ajax' => 'action' ) ) ?]
        [?php echo Url::link( I18n::__( 'admin.labels.nextPage' ), $url . '?page=' . $pager->getNextPage(), array( 'class' => 'sf_pg_next' . ( $pager->getPage() == $pager->getLastPage() ? ' ui-state-disabled' : '' ), 'ajax' => 'action' ) ) ?]
    </div>
    <div class="views">
        [?php echo I18n::__( 'admin.texts.views', array( '%1%' => $first, '%2%' => ( $last > $pager->getNbResults() ) ? $pager->getNbResults() : $last, '%3%' => $pager->getNbResults() ) ) ?]
    </div>
</div>
