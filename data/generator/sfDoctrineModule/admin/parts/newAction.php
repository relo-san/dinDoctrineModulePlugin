
    public function executeNew( sfWebRequest $request )
    {

        sfWidgetFormSchema::setDefaultFormFormatterName( 'embedded' );
        $this->form = $this->configuration->getForm();
        $this-><?php echo $this->getSingularName() ?> = $this->form->getObject();
        $this->form->getWidgetSchema()->getFormFormatter()
            ->setTranslationCatalogue( '<?php echo $this->getI18nCatalogue() ?>' );

    } // <?php echo $this->getGeneratedModuleName() ?>Actions::executeNew()
