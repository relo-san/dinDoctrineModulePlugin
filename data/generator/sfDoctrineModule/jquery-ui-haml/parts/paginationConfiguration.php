
    public function getPagerClass()
    {

        return '<?php echo isset( $this->config['list']['pager_class'] ) ? $this->config['list']['pager_class'] : 'sfDoctrinePager' ?>';
<?php unset( $this->config['list']['pager_class'] ) ?>

    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration::getPagerClass()


    public function getPagerMaxPerPage()
    {

        return <?php echo isset( $this->config['list']['max_per_page'] ) ? (integer) $this->config['list']['max_per_page'] : 20 ?>;
<?php unset( $this->config['list']['max_per_page'] ) ?>

    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration::getPagerMaxPerPage()