
    public function executeFilter( sfWebRequest $request )
    {

        $this->setPage( 1 );

        if ( $request->hasParameter( '_reset' ) )
        {
            $this->setFilters( $this->configuration->getFilterDefaults() );
            $this->forward( '<?php echo $this->getModuleName() ?>', 'index' );
        }

        $this->filters = $this->configuration->getFilterForm( $this->getFilters() );

        if ( $request->hasParameter( $this->filters->getName() ) )
        {
            $this->filters->bind( $request->getParameter( $this->filters->getName() ) );
            if ( $this->filters->isValid() )
            {
                $this->setFilters( $this->filters->getValues() );
            }
            $this->forward( '<?php echo $this->getModuleName() ?>', 'index' );
        }

        $this->filters->getWidgetSchema()->getFormFormatter()
            ->setTranslationCatalogue( '<?php echo $this->getI18nCatalogue() ?>' );

        return $this->renderPartial( '<?php echo $this->getModuleName() ?>/filters', array( 'form' => $this->filters, 'helper' => $this->helper, 'configuration' => $this->configuration ) );

    } // <?php echo $this->getGeneratedModuleName() ?>Actions::executeFilter()
