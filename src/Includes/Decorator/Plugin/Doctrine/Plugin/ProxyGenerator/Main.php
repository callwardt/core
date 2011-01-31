<?php
// vim: set ts=4 sw=4 sts=4 et:

/**
 * LiteCommerce
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to licensing@litecommerce.com so we can send you a copy immediately.
 * 
 * @category   LiteCommerce
 * @package    XLite
 * @subpackage Includes
 * @author     Creative Development LLC <info@cdev.ru> 
 * @copyright  Copyright (c) 2011 Creative Development LLC <info@cdev.ru>. All rights reserved
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @version    GIT: $Id$
 * @link       http://www.litecommerce.com/
 * @see        ____file_see____
 * @since      3.0.0
 */

namespace Includes\Decorator\Plugin\Doctrine\Plugin\ProxyGenerator;

/**
 * Routines for Doctrine library
 *
 * @package XLite
 * @see     ____class_see____
 * @since   3.0.0
 */
class Main extends \Includes\Decorator\Plugin\Doctrine\Plugin\APlugin
{
    /**
     * Check if proxy classes are already generated
     *
     * @return bool
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function areProxiesExist()
    {
        return \Includes\Utils\FileManager::isDirReadable(LC_PROXY_CACHE_DIR);
    }


    /**
     * Execute "postprocess" hook handler
     * 
     * @return void
     * @access public
     * @see    ____func_see____
     * @since  3.0.0
     */
    public function executeHookHandlerPostprocess()
    {
        if (!$this->areProxiesExist()) {

            // Create the proxies folder
            \Includes\Utils\FileManager::mkdirRecursive(LC_PROXY_CACHE_DIR);

            // Create model proxy classes (second step of cache generation)
            \Includes\Decorator\Plugin\Doctrine\Utils\EntityManager::generateProxies();
        }
    }
}
