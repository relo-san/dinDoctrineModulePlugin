
    public function executeIndex( sfWebRequest $request )
    {

<?php
echo "        if ( \$request->getParameter( 'sort' ) && \$this->isValidSortRule( \$request->getParameter( 'sort' ) ) )\n";
echo "        {\n";
echo "            \$this->setSort( array( \$request->getParameter( 'sort' ), \$request->getParameter( 'sort_type' ) ) );\n";
echo "        }\n\n";

echo "        if ( \$request->getParameter( 'page' ) )\n";
echo "        {\n";
echo "            \$this->setPage( \$request->getParameter( 'page' ) );\n";
echo "        }\n\n";

echo "        \$this->pager = \$this->getPager();\n";
echo "        \$this->sort = \$this->getSort();\n";
echo '        $this->hasFilters = ' . ( $this->configuration->hasFilterForm() ? '$this->getFilters()' : 'false' ) . ";\n\n";
?>
    } // <?php echo $this->getGeneratedModuleName() ?>Actions::executeIndex()
