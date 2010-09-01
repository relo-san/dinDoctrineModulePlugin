
    public function executeEdit( sfWebRequest $request )
    {

        sfWidgetFormSchema::setDefaultFormFormatterName( 'embedded' );
        $this-><?php echo $this->getSingularName() ?> = $this->getRoute()->getObject();
        $this->form = $this->configuration->getForm( $this-><?php echo $this->getSingularName() ?> );
        $this->form->getWidgetSchema()->getFormFormatter()
            ->setTranslationCatalogue( '<?php echo $this->getI18nCatalogue() ?>' );

    } // <?php echo $this->getGeneratedModuleName() ?>Actions::executeEdit()
