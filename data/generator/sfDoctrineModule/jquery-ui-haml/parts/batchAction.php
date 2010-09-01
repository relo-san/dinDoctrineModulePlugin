
    public function executeBatch( sfWebRequest $request )
    {

        $request->checkCSRFProtection();

        if ( !$action = $request->getParameter( 'batch_action' ) )
        {
            $this->forward( '<?php echo $this->getModuleName() ?>', 'index' );
        }

        if ( !$ids = $request->getParameter( 'ids' ) )
        {
            $this->getUser()->setFlash( 'error', 'admin.messages.selectItems' );
            $this->forward( '<?php echo $this->getModuleName() ?>', 'index' );
        }

        if ( !method_exists( $this, $method = 'execute' . ucfirst( $action ) ) )
        {
            throw new InvalidArgumentException( sprintf( 'You must create a "%s" method for action "%s"', $method, $action ) );
        }

        if ( !$this->getUser()->hasCredential( $this->configuration->getCredentials( $action ) ) )
        {
            $this->forward( sfConfig::get( 'sf_secure_module' ), sfConfig::get( 'sf_secure_action' ) );
        }

        $validator = new sfValidatorDoctrineChoice( array( 'multiple' => true, 'model' => '<?php echo $this->getModelClass() ?>' ) );
        try
        {
            $ids = $validator->clean( $ids );
            $this->$method( $request );
        }
        catch ( sfValidatorError $e )
        {
            $this->getUser()->setFlash( 'error', 'admin.messages.itemsNotExist' );
        }

        $this->forward( '<?php echo $this->getModuleName() ?>', 'index' );

    } // <?php echo $this->getGeneratedModuleName() ?>Actions::executeBatch()


    protected function executeBatchDelete( sfWebRequest $request )
    {

        $records = Doctrine_Query::create()
            ->from( '<?php echo $this->getModelClass() ?>' )
            ->whereIn( '<?php echo $this->getPrimaryKeys( true ) ?>', $request->getParameter( 'ids' ) )
            ->execute();

        foreach ( $records as $record )
        {
            $record->delete();
        }

        $this->getUser()->setFlash( 'notice', 'admin.messages.batchDeleteSuccess' );
        $this->forward( '<?php echo $this->getModuleName() ?>', 'index' );

    } // <?php echo $this->getGeneratedModuleName() ?>Actions::executeBatchDelete()
