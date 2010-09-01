<?php

/*
 * This file is part of the dinDoctrineModulePlugin package.
 * (c) DineCat, 2010 http://dinecat.com/
 * 
 * For the full copyright and license information, please view the LICENSE file,
 * that was distributed with this package, or see http://www.dinecat.com/din/license.html
 */

/**
 * Dashboard components
 * 
 * @package     dinDoctrineModulePlugin
 * @subpackage  modules.dinAdminDashboard.actions
 * @author      Nicolay N. Zyk <relo.san@gmail.com>
 */
class dinAdminDashboardComponents extends sfComponents
{

    /**
     * Header component
     * 
     * @param   sfWebRequest    $request
     * @return  string          View name constant
     */
    public function executeHeader( sfWebRequest $request )
    {

        // TODO: add menu handler
        $this->categories = array();

    } // dinAdminDashboardComponents::executeHeader()

} // dinAdminDashboardComponents

//EOF