<?php
// vim: set ts=4 sw=4 sts=4 et:

/**
 * LiteCommerce
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Pubic License (GPL 2.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-2.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to licensing@litecommerce.com so we can send you a copy immediately.
 *
 * PHP version 5.3.0
 *
 * @category  LiteCommerce
 * @author    Creative Development LLC <info@cdev.ru>
 * @copyright Copyright (c) 2011-2012 Creative Development LLC <info@cdev.ru>. All rights reserved
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU General Pubic License (GPL 2.0)
 * @link      http://www.litecommerce.com/
 */

namespace XLite\Module\CDev\DrupalConnector\Controller\Customer;

/**
 * Invoice controller
 *
 * @see   ____class_see____
 * @since 1.0.0
 */
class Invoice extends \XLite\Controller\Customer\Invoice implements \XLite\Base\IDecorator
{
    /**
     * Argument convertion: <LC> --> <DRUPAL>
     *
     * @param string $path Drupal path
     * @param array  $args LC URL arguments OPTIONAL
     *
     * @return array
     * @see    ____func_see____
     * @since  1.0.0
     */
    public static function getPortalDrupalArgs($path, array $args = array())
    {
        if (!empty($args['printable'])) {
            $path = 'print/' . $path;
        }
        unset($args['printable']);

        return parent::getPortalDrupalArgs($path, $args);
    }
}
