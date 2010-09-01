
    public function executeNew( sfWebRequest $request )
    {

<?php
echo "        sfWidgetFormSchema::setDefaultFormFormatterName( 'embedded' );\n";
echo "        \$this->form = \$this->configuration->getForm();\n";
echo "        \$this->" . $this->getSingularName() . " = \$this->form->getObject();\n";
echo "        \$this->form->getWidgetSchema()->getFormFormatter()\n";
echo "            ->setTranslationCatalogue( '" . $this->getI18nCatalogue() . "' );\n\n";
?>
    } // <?php echo $this->getGeneratedModuleName() ?>Actions::executeNew()

<?php if ( $this->configuration->hasNSTree() ): ?>

    public function executeListNew( sfWebRequest $request )
    {

<?php
echo "        \$this->executeNew( \$request );\n";
echo "        \$this->form->setDefault( 'parent_id', \$request->getParameter( 'id' ) );\n";
echo "        \$this->setTemplate( 'new' );\n\n";
?>
    } // <?php echo $this->getGeneratedModuleName() ?>Actions::executeListNew()

<?php endif ?>