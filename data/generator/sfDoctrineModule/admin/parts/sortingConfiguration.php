
    public function getDefaultSort()
    {

        $sort = $this->getSortRules();
        if ( isset( $sort['default'] ) )
        {
            return array( 'default', isset( $sort['default']['type'] ) ? $sort['default']['type'] : 'asc' );
        }
        else
        {
            return array( null, null );
        }

    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration::getDefaultSort()


    public function getSortRules()
    {

        return array(
<?php if ( isset( $this->config['list']['sort'] ) && is_array( $this->config['list']['sort'] ) ): ?>
<?php foreach ( $this->config['list']['sort'] as $sort => $params ): ?>
            '<?php echo $sort ?>' => <?php echo $this->asPhp( $params ) ?>,
<?php endforeach ?>
<?php endif ?>
        );
<?php unset( $this->config['list']['sort'] ) ?>

    }
