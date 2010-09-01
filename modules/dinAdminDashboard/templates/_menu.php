<?php $categories = $sf_data->getRaw( 'categories' ) ?>
<?php if ( count( $categories ) ): ?>
<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
    <?php foreach ( $categories as $name => $category ): ?>
    <?php if ( count( $category['items'] ) ): ?>
    <li class="node ui-state-default ui-corner-top"><a href="javascript:void(0)"><?php echo I18n::__( 'menu.labels.category.' . $name ) ?></a>
        <ul>
            <?php foreach ( $category['items'] as $title => $item ): ?>
            <li class="item<?php echo isset( $item['class'] ) ? ' ' . $item['class'] : '' ?>">
                <?php echo Url::link( '<sub></sub>' . I18n::__( 'menu.labels.item.' . $title ), $item['url'], array( 'ajax' => 'action', 'onfocus' => 'blur()' ) ) ?>
            </li>
            <?php endforeach ?>
        </ul>
    </li>
    <?php else: ?>
    <li class="node">
        <?php echo Url::link( I18n::__( 'menu.labels.category.' . $name ), $category['url'], array( 'ajax' => 'action' ) ) ?>
    </li>
    <?php endif ?>
    <?php endforeach ?>
</ul>
<?php endif ?>