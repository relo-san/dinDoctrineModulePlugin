
    public function executeUpdate( sfWebRequest $request )
    {

        sfWidgetFormSchema::setDefaultFormFormatterName( 'embedded' );
        $this-><?php echo $this->getSingularName() ?> = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm( $this-><?php echo $this->getSingularName() ?> );
        $this->form->getWidgetSchema()->getFormFormatter()
            ->setTranslationCatalogue( '<?php echo $this->getI18nCatalogue() ?>' );
        $this->processForm( $request, $this->form );
        $this->setTemplate( 'edit' );

    } // <?php echo $this->getGeneratedModuleName() ?>Actions::executeUpdate()
