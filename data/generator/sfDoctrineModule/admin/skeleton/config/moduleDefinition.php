<?php

/*
 * This file is part of the ##PLUGIN_NAME## package.
 * (c) DineCat, 2010 http://dinecat.com/
 * 
 * For the full copyright and license information, please view the LICENSE file,
 * that was distributed with this package, or see http://www.dinecat.com/din/license.html
 */

/**
 * Base ##MODULE_NAME## module definition
 * 
 * @package     ##PLUGIN_NAME##.modules.##MODULE_NAME##.config
 * @signed      5
 * @signer      relo_san
 * @author      relo_san [http://relo-san.com/]
 * @since       ##DATE##
 * @version     SVN: $Id: moduleDefinition.php 13 2010-02-26 20:31:36Z relo_san $
 */
class Plugin##UC_MODULE_NAME##ModuleDefinition extends DinModuleDefinition
{

    protected $definitions = array(
        'plugin'    => '##PLUGIN_NAME##',
        'generator' => array(
            'class' => 'dinDoctrineGenerator',
            'param' => array(

                // module config
                'actions_base_class'    => '##BASE_ACTION##',
                'model_class'           => '##MODEL_CLASS##',
                'theme'                 => '##THEME##',
                'non_verbose_templates' => ##VERBOSE##,
                'with_show'             => ##WITH_SHOW##,
                'singular'              => ##SINGULAR##,
                'plural'                => ##PLURAL##,
                'route_prefix'          => ##ROUTE_PREFIX##,
                'with_doctrine_route'   => ##WITH_ROUTE##,
                'css'                   => false,
                'i18n_catalogue'        => '##MODULE_NAME##',

                // actions config
                'config' => array(

                    'actions'           => null,

                    'fields'            => array(),

                    'list'              => array(
                        'title'         => 'titles.list',
                        'display'       => array(),
                        'table_method'  => 'retrieveWithI18n',
                        'pager_class'   => 'dinDoctrinePager',
                        'object_actions'=> array(
                            '_edit'     => array( 'params' => array( 'ajax' => 'action' ) )
                        ),
                        'sort'          => array()
                    ),

                    'filter'            => array(
                        'display'       => array()
                    ),

                    'form'              => array(
                        'display'       => array(
                            'fieldsets.base'    => array(),
                            'translated'        => array()
                        )
                    ),

                    'edit'              => array(
                        'title'         => 'titles.edit.%%title%%',
                        'actions'       => array(
                            '_save'     => null,
                            '_list'     => array( 'params' => array( 'ajax' => 'action' ) )
                        )
                    ),

                    'new'               => array(
                        'title'         => 'titles.new',
                        'actions'       => array(
                            '_save_and_add' => null,
                            '_save'         => null,
                            '_list'         => array( 'params' => array( 'ajax' => 'action' ) )
                        )
                    ),

                    'show'              => null

                )

            )
        )
    );

} // Plugin##UC_MODULE_NAME##ModuleDefinition

//EOF