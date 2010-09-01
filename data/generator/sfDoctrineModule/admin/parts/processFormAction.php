
    protected function processForm( sfWebRequest $request, sfForm $form )
    {

        $form->bind( $request->getParameter( $form->getName() ), $request->getFiles( $form->getName() ) );
        if ( $form->isValid() )
        {
            $notice = 'admin.messages.' . ( $form->getObject()->isNew() ? 'createSuccess' : 'updateSuccess' );

            try {
                $<?php echo $this->getSingularName() ?> = $form->save();
            }
            catch ( Doctrine_Validator_Exception $e )
            {

                $errorStack = $form->getObject()->getErrorStack();

                $message = get_class( $form->getObject() ) . ' has ' . count( $errorStack ) . " field" . ( count( $errorStack ) > 1 ?  's' : null ) . " with validation errors: ";
                foreach ( $errorStack as $field => $errors )
                {
                    $message .= "$field (" . implode( ", ", $errors ) . "), ";
                }
                $message = trim( $message, ', ' );

                $this->getUser()->setFlash( 'error', $message );
                return sfView::SUCCESS;
            }

            $this->dispatcher->notify( new sfEvent( $this, 'admin.save_object', array( 'object' => $<?php echo $this->getSingularName() ?> ) ) );

            if ( $request->hasParameter( '_save_and_add' ) )
            {
                $this->getUser()->setFlash( 'notice', $notice . 'Next' );
                $this->forward( '<?php echo $this->getModuleName() ?>', 'new' );
            }
            else
            {
                $this->getUser()->setFlash( 'notice', $notice );
                $this->changeRoute( '<?php echo $this->getUrlForAction( 'edit' ) ?>', array_merge( $request->getParameterHolder()->getAll() ,array( 'id' => $<?php echo $this->getSingularName() ?>->getId() ) ) );
                $this->forward( '<?php echo $this->getModuleName() ?>', 'edit' );
            }
        }
        else
        {
            $this->getUser()->setFlash( 'error', 'admin.messages.saveError', false );
        }

    } // <?php echo $this->getGeneratedModuleName() ?>Actions::processForm()
