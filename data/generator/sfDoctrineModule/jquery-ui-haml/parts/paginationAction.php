
    protected function getPager()
    {

<?php
echo "        \$pager = \$this->configuration->getPager( '" . $this->getModelClass() . "' );\n";
echo "        \$pager->setQuery( \$this->buildQuery() );\n";
echo "        \$pager->setPage( \$this->getPage() );\n";
echo "        \$pager->init();\n\n";

echo "        return \$pager;\n\n";
?>
    } // <?php echo $this->getGeneratedModuleName() ?>Actions::getPager()


    protected function setPage( $page )
    {

        <?php echo "\$this->getUser()->setAttribute( '" . $this->getModuleName() . ".page', \$page, 'admin_module' );\n" ?>

    } // <?php echo $this->getGeneratedModuleName() ?>Actions::setPage()


    protected function getPage()
    {

        <?php echo "return \$this->getUser()->getAttribute( '" . $this->getModuleName() . ".page', 1, 'admin_module' );\n" ?>

    } // <?php echo $this->getGeneratedModuleName() ?>Actions::getPage()


    protected function buildQuery()
    {

<?php
echo "        \$tableMethod = \$this->configuration->getTableMethod();\n";

if ( $this->configuration->hasFilterForm() )
{
    echo "        if ( null === \$this->filters )\n";
    echo "        {\n";
    echo "            \$this->filters = \$this->configuration->getFilterForm( \$this->getFilters() );\n";
    echo "        }\n\n";

    echo "        \$this->filters->setTableMethod( \$tableMethod );\n";

    echo "        \$query = \$this->filters->buildQuery( \$this->getFilters() );\n\n";
}
else
{
    echo "        \$query = Doctrine::getTable( '" . $this->getModelClass() . "' )\n";
    echo "            ->createQuery( 'a' );\n\n";

    echo "        if ( \$tableMethod )\n";
    echo "        {\n";
    echo "            \$query = Doctrine::getTable( '" . $this->getModelClass() . "' )->\$tableMethod( \$query );\n";
    echo "        }\n\n";
}

echo "        \$this->addSortQuery( \$query );\n\n";

echo "        \$event = \$this->dispatcher->filter( new sfEvent( \$this, 'admin.build_query' ), \$query );\n";
echo "        \$query = \$event->getReturnValue();\n\n";

if ( $this->configuration->hasParent() )
{
    $parent = $this->configuration->getLastParent();
    echo "        \$query->andWhere(\n";
    echo "            \$query->getRootAlias() . '." . $parent['identifier'] . " = ?', \$this->request->getParameter( '" . $parent['identifier'] . "', 0 )\n";
    echo "        );\n\n";
}

echo "        return \$query;\n\n";
?>
    } // <?php echo $this->getGeneratedModuleName() ?>Actions::buildQuery()
