[?php

/**
 * <?php echo $this->getModuleName() ?> module configuration
 * 
 * @package    ##PROJECT_NAME##
 * @subpackage <?php echo $this->getModuleName()."\n" ?>
 * @author     ##AUTHOR##
 */
abstract class Base<?php echo ucfirst($this->getModuleName()) ?>GeneratorConfiguration extends sfModelGeneratorConfiguration
{
<?php include dirname( __FILE__ ) . '/actionsConfiguration.php' ?>
<?php include dirname( __FILE__ ) . '/fieldsConfiguration.php' ?>

    /**
     * Gets the form class name
     * 
     * @return string The form class name
     */
    public function getFormClass()
    {

        return '<?php echo isset( $this->config['form']['class'] ) ? $this->config['form']['class'] : $this->getModelClass() . 'Form' ?>';
<?php unset( $this->config['form']['class'] ) ?>

    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration::getFormClass()


    public function hasFilterForm()
    {

        return <?php echo !isset( $this->config['filter']['class'] ) || false !== $this->config['filter']['class'] ? 'true' : 'false' ?>;

    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration::hasFilterForm()


    /**
     * Gets the filter form class name
     * 
     * @return string The filter form class name associated with this generator
     */
    public function getFilterFormClass()
    {

        return '<?php echo isset( $this->config['filter']['class'] ) && !in_array( $this->config['filter']['class'], array( null, true, false ), true ) ? $this->config['filter']['class'] : $this->getModelClass() . 'FormFilter' ?>';
<?php unset( $this->config['filter']['class'] ) ?>

    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration::getFilterFormClass()

<?php include dirname( __FILE__ ) . '/paginationConfiguration.php' ?>
<?php include dirname( __FILE__ ) . '/sortingConfiguration.php' ?>

    public function getTableMethod()
    {

        return '<?php echo isset( $this->config['list']['table_method'] ) ? $this->config['list']['table_method'] : null ?>';
<?php unset( $this->config['list']['table_method'] ) ?>

    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration::getTableMethod()


    public function getTableCountMethod()
    {

        return '<?php echo isset($this->config['list']['table_count_method']) ? $this->config['list']['table_count_method'] : null ?>';
<?php unset( $this->config['list']['table_count_method'] ) ?>

    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration::getTableCountMethod()


    public function hasNSTree()
    {

        return <?php echo ( isset( $this->config['extend']['NSTree'] ) && $this->config['extend']['NSTree'] ? 'true' : 'false' ) . ";\n" ?>

    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration::hasNSTree()


    public function hasParent()
    {

        return <?php echo ( isset( $this->config['parent'] ) && $this->config['parent'] ? 'true' : 'false' ) . ";\n" ?>

    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration::hasParent()


    /**
     * Get parent links
     * 
     * @return  array   Parent links
     */
    public function getParentLinks()
    {

<?php
$plinks = array();
if ( isset( $this->config['parent'] ) && is_array( $this->config['parent'] ) )
{
    foreach ( $this->config['parent'] as $pname => $pparams )
    {
        if ( isset( $pparams['route'] ) && $pparams['route'] )
        {
            $plinks[$this->getI18nCatalogue() . '.' . $pparams['label']] = '@' . $pparams['route'];
        }
    }
}
echo "        return " . $this->asPhp( $plinks ) . ";\n\n";
?>
    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration::getParentLinks()

<?php if ( isset( $this->config['parent'] ) ): ?>

    public function getParents()
    {

        return <?php echo $this->asPhp( isset( $this->config['parent'] ) ? $this->config['parent'] : array() ) ?>;

    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration::getParents()


    public function getLastParent()
    {

<?php
//foreach ( $this->config['parent'] as $pname => $pparams ){}
echo "        return " . $this->asPhp( isset( $pparams ) ? $pparams : array() ) . ";\n\n";
?>
    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration::getLastParent()

<?php endif ?>
<?php if ( isset( $this->config['parent'] ) || ( isset( $this->config['extend']['NSTree'] ) && $this->config['extend']['NSTree'] ) ): ?>

    /**
     * Get form
     * 
     * @param   <?php echo $this->getModelClass() ?>  $object
     * @param   array   $options    Options to merge with the options returned by getFormOptions()
     * @return  <?php echo $this->getModelClass() ?>Form
     */
    public function getForm( $object = null, $options = array() )
    {

<?php
echo "        \$form = parent::getForm( \$object );\n";
if ( isset( $this->config['parent'] ) )
{
    echo "        \$id = sfContext::getInstance()->getRequest()->getParameter( '" . $pparams['identifier'] . "' );\n";
    echo "        \$form->setDefault( '" . $pparams['identifier'] . "', \$id );\n";
    echo "        \$form->getObject()->" . $pparams['identifier'] . " = \$id;\n\n";
}
if ( isset( $this->config['extend']['NSTree'] ) && $this->config['extend']['NSTree'] )
{
    echo "        \$id = sfContext::getInstance()->getRequest()->getParameter( 'id' );\n";
    echo "        \$form->setDefault( 'parent_id', \$object ? \$object->getParentId() : \$id );\n\n";
}
echo "        return \$form;\n\n";

unset( $this->config['parent'] );
unset( $this->config['extend'] );
?>
    } // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration::getForm()

<?php endif ?>
} // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration

//EOF