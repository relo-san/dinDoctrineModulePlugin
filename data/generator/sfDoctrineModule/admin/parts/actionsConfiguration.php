
    public function getActionsDefault()
    {

        return <?php echo $this->asPhp( isset( $this->config['actions'] ) ? $this->config['actions'] : array() ) ?>;
<?php unset($this->config['actions']) ?>

    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration::getActionsDefault()


    public function getFormActions()
    {

        return <?php echo $this->asPhp( isset( $this->config['form']['actions'] ) ? $this->config['form']['actions'] : array( '_delete' => null, '_list' => null, '_save' => null, '_save_and_add' => null ) ) ?>;
<?php unset( $this->config['form']['actions'] ) ?>

    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration::getFormActions()


    public function getNewActions()
    {

        return <?php echo $this->asPhp( isset( $this->config['new']['actions'] ) ? $this->config['new']['actions'] : array() ) ?>;
<?php unset( $this->config['new']['actions'] ) ?>

    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration::getNewActions()


    public function getEditActions()
    {

        return <?php echo $this->asPhp( isset( $this->config['edit']['actions'] ) ? $this->config['edit']['actions'] : array() ) ?>;
<?php unset( $this->config['edit']['actions'] ) ?>

    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration::getEditActions()


    public function getListObjectActions()
    {

        return <?php echo $this->asPhp( isset( $this->config['list']['object_actions'] ) ? $this->config['list']['object_actions'] : array( '_edit' => null, '_delete' => null ) ) ?>;
<?php unset( $this->config['list']['object_actions'] ) ?>

    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration::getListObjectActions()


    public function getListActions()
    {

        return <?php echo $this->asPhp( isset( $this->config['list']['actions'] ) ? $this->config['list']['actions'] : array( '_new' => null ) ) ?>;
<?php unset( $this->config['list']['actions'] ) ?>

    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration::getListActions()


    public function getListBatchActions()
    {

        return <?php echo $this->asPhp( isset( $this->config['list']['batch_actions'] ) ? $this->config['list']['batch_actions'] : array( '_delete' => null ) ) ?>;
<?php unset( $this->config['list']['batch_actions'] ) ?>

    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration::getListBatchActions()
