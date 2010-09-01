<?php

/*
 * This file is part of the dinDoctrineModulePlugin package.
 * (c) DineCat, 2010 http://dinecat.com/
 * 
 * For the full copyright and license information, please view the LICENSE file,
 * that was distributed with this package, or see http://www.dinecat.com/din/license.html
 */

/**
 * Doctrine generator
 * 
 * @package     dinDoctrineModulePlugin
 * @subpackage  lib.generator
 * @author      Nicolay N. Zyk <relo.san@gmail.com>
 */
class dinDoctrineGenerator extends sfDoctrineGenerator
{

    /**
     * generate
     * 
     * @return  
     */
    public function generate( $params = array() )
    {

        $this->validateParameters( $params );

        $this->modelClass = $this->params['model_class'];

        $this->setModuleName( $this->params['moduleName'] );
        $this->setGeneratedModuleName( 'auto' . ucfirst( $this->params['moduleName'] ) );

        $theme = isset( $this->params['theme'] ) ? $this->params['theme'] : 'default';
        $this->setTheme( $theme );
        $themeDir = $this->generatorManager->getConfiguration()->getGeneratorTemplate(
            $this->getGeneratorClass(), $theme, ''
        );
        if ( !is_dir( $themeDir ) )
        {
            throw new sfConfigurationException( sprintf( 'The theme "%s" does not exist.', $theme ) );
        }

        $this->configure();

        $this->configuration = $this->loadConfiguration();

        $this->generatePhpFiles(
            $this->generatedModuleName, sfFinder::type( 'file' )->relative()->in( $themeDir )
        );

        $file = $this->generatorManager->getBasePath() . '/' . $this->getGeneratedModuleName()
            . '/lib/helper.php';
        if ( file_exists( $file ) )
        {
            @rename( $file, $this->generatorManager->getBasePath() . '/'
                . $this->getGeneratedModuleName() . '/lib/Base' . ucfirst( $this->moduleName )
                . 'GeneratorHelper.php' );
        }

        return "require_once( sfConfig::get( 'sf_module_cache_dir' ) . '/"
            . $this->generatedModuleName . "/actions/actions.class.php');";

    } // dinDoctrineGenerator::generate()


    /**
     * Get I18N call representation
     * 
     * @param   string  $key    Configuration key
     * @return  string  PHP code
     */
    public function getI18NString( $key )
    {

        $value = $this->configuration->getValue( $key, '', true );

        $parts = explode( '.' , $key );
        $context = $parts[0];

        // find %%xx%% strings
        preg_match_all( '/%%([^%]+)%%/', $value, $matches, PREG_PATTERN_ORDER );
        $fields = array();
        foreach ( $matches[1] as $name )
        {
            $fields[] = $name;
        }

        $vars = array();
        foreach ( $this->configuration->getContextConfiguration( $context, $fields ) as $field )
        {
            $vars[] = '\'%%' . $field->getName() . '%%\' => ' . $this->renderField( $field );
        }

        // find %@xx@% strings
        preg_match_all( '/%@([^@]+)@%/', $value, $matches, PREG_PATTERN_ORDER );
        foreach ( $matches[1] as $name )
        {
            $vars[] = '\'%@' . $name . '@%\' => ' . '$helper->get' . sfInflector::camelize( $name ) . 'Name()';
        }

        return sprintf(
            "I18n::__( '%s.%s', array( %s ) )",
            $this->getI18nCatalogue(), $value, implode( ', ', $vars )
        );

    } // dinDoctrineGenerator::getI18NString()


    /**
     * Returns HTML code for a field
     * 
     * @param   sfModelGeneratorConfigurationField  $field
     * @return  string  HTML code
     */
    public function renderField( $field )
    {

        $html = $this->getColumnGetter( $field->getName(), true );

        if ( $renderer = $field->getRenderer() )
        {
            $html = sprintf(
                "$html ? call_user_func_array( %s, array_merge( array(%s), %s ) ) : '&nbsp;'",
                $this->asPhp( $renderer ), $html, $this->asPhp( $field->getRendererArguments() )
            );
        }
        else if ( $field->isComponent() )
        {
            return sprintf(
                "Partial::component( '%s', '%s', array( 'type' => 'list', '%s' => \$%s ) )",
                $this->getModuleName(), $field->getName(),
                $this->getSingularName(), $this->getSingularName()
            );
        }
        else if ( $field->isPartial() )
        {
            return sprintf(
                "Partial::get( '%s', array( 'type' => 'list', '%s' => \$%s ) )",
                $field->getName(), $this->getSingularName(), $this->getSingularName()
            );
        }
        else if ( 'Date' == $field->getType() )
        {
            $html = sprintf(
                "false !== strtotime( $html ) ? Date::formatDate( %s, \"%s\" ) : '&nbsp;'",
                $html, $field->getConfig('date_format', 'f' )
            );
        }
        else if ( 'Boolean' == $field->getType() )
        {
            $html = sprintf(
                "'<div class=\"ui-icon' . ( %s ? ' ui-icon-check' : ' ui-icon-close' ) . '\" title=\"'"
                    . " . I18n::__( 'admin.label.' . ( %s ? '' : 'un' ) . 'checked' ) . '\"></div>'",
                $html, $html
            );
        }

        if ( $field->isLink() )
        {
            $html = sprintf( "Url::link( %s, '%s', \$%s )", $html, $this->getUrlForAction( 'edit' ), $this->getSingularName() );
        }

        return $html;

    } // dinDoctrineGenerator::renderField()


    /**
     * Returns HTML code for an action link
     *
     * @param   string  $actionName The action name
     * @param   array   $params     The parameters
     * @param   boolean $pkLink     Whether to add a primary key link or not
     * @return  string  HTML code
     */
    public function getLinkToAction( $actionName, $params, $pkLink = false )
    {

        $action = isset( $params['action'] ) ? $params['action'] : 'List' . sfInflector::camelize( $actionName );
        $urlParams = $pkLink ? '?' . $this->getPrimaryKeyUrlParams() : "'";
        return "[?php echo Url::link( I18n::__( '" . $this->getI18nCatalogue() . '.' . substr( mb_strtolower( $params['label'] ), 0, 1 ) . substr( $params['label'], 1 ) . "' ), '" . $this->getModuleName() . '/' . $action . $urlParams . ', ' . $this->asPhp( $params['params'] ) . ' ) ?]';

    } // dinDoctrineGenerator::getLinkToAction()


    /**
     * loadConfiguration
     * 
     * @return  
     */
    protected function loadConfiguration()
    {

        try
        {
            $this->generatorManager->getConfiguration()->getGeneratorTemplate(
                $this->getGeneratorClass(), $this->getTheme(), '../parts/configuration.php'
            );
        }
        catch ( sfException $e )
        {
            return null;
        }

        $config = $this->getGeneratorManager()->getConfiguration();
        if ( !$config instanceof sfApplicationConfiguration )
        {
            throw new LogicException(
                'The sfModelGenerator can only operates with an application configuration.'
            );
        }

        $basePath = $this->getGeneratedModuleName() . '/lib/Base'
            . ucfirst( $this->getModuleName() ) . 'GeneratorConfiguration.php';
        $this->getGeneratorManager()->save(
            $basePath, $this->evalTemplate( '../parts/configuration.php' )
        );

        require_once $this->getGeneratorManager()->getBasePath() . '/' . $basePath;

        $class = 'Base' . ucfirst( $this->getModuleName() ) . 'GeneratorConfiguration';
        foreach ( $config->getLibDirs( $this->getModuleName() ) as $dir )
        {
            $configuration = $dir . '/' . $this->getModuleName() . 'GeneratorConfiguration.php';
            if ( !is_file( $configuration ) )
            {
                continue;
            }

            require_once $configuration;
            $class = $this->getModuleName() . 'GeneratorConfiguration';
            break;
        }

        foreach ( $this->config as $context => $value )
        {
            if ( !$value )
            {
                continue;
            }

            throw new InvalidArgumentException( sprintf(
                'Your generator configuration contains some errors for the "%s" context.'
                    . ' The following configuration cannot be parsed: %s.',
                $context, $this->asPhp( $value )
            ) );
        }

        return new $class();

    } // dinDoctrineGenerator::loadConfiguration()

} // dinDoctrineGenerator

//EOF