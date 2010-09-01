[?php

/**
 * <?php echo $this->getModuleName() ?> module configuration
 * 
 * @package    ##PROJECT_NAME##
 * @subpackage <?php echo $this->getModuleName()."\n" ?>
 * @author     relo_san [http://relo-san.com/]
 * @version    SVN: $Id: configuration.php 7 2010-02-14 11:56:25Z relo_san $
 */
abstract class Base<?php echo ucfirst($this->getModuleName()) ?>GeneratorConfiguration extends sfModelGeneratorConfiguration
{
<?php include dirname( __FILE__ ) . '/actionsConfiguration.php' ?>
<?php include dirname( __FILE__ ) . '/fieldsConfiguration.php' ?>

    /**
     * Get parent links
     * 
     * @return  array   Parent links
     */
    public function getParentLinks()
    {

        return <?php echo $this->asPhp( isset( $this->config['parent_links'] ) ? $this->config['parent_links'] : array() ) ?>;
<?php unset( $this->config['parent_links'] ) ?>

    } // Base<?php echo ucfirst($this->getModuleName()) ?>GeneratorConfiguration::getParentLinks()


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

<?php include dirname(__FILE__).'/paginationConfiguration.php' ?>
<?php include dirname(__FILE__).'/sortingConfiguration.php' ?>

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

} // Base<?php echo ucfirst( $this->getModuleName() ) ?>GeneratorConfiguration

//EOF