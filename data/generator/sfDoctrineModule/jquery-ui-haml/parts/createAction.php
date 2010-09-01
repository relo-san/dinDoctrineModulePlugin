
    public function executeCreate( sfWebRequest $request )
    {

        sfWidgetFormSchema::setDefaultFormFormatterName( 'embedded' );
        $this->form = $this->configuration->getForm();
        $this-><?php echo $this->getSingularName() ?> = $this->form->getObject();
        $this->form->getWidgetSchema()->getFormFormatter()
            ->setTranslationCatalogue( '<?php echo $this->getI18nCatalogue() ?>' );
        $this->processForm( $request, $this->form );
        $this->setTemplate( 'new' );

    } // <?php echo $this->getGeneratedModuleName() ?>Actions::executeCreate()
