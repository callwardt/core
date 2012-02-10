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
 * PHP version 5.3.0
 *
 * @category  LiteCommerce
 * @author    Creative Development LLC <info@cdev.ru>
 * @copyright Copyright (c) 2011 Creative Development LLC <info@cdev.ru>. All rights reserved
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.litecommerce.com/
 * @see       ____file_see____
 * @since     1.0.16
 */

namespace XLite\View\Button\Attribute;

/**
 * AssignClasses
 *
 * @see   ____class_see____
 * @since 1.0.16
 */
class AssignClasses extends \XLite\View\Button\Attribute\Base\Popup
{
    /**
     * Register JS files
     *
     * @return array
     * @see    ____func_see____
     * @since  1.0.16
     */
    public function getJSFiles()
    {
        $list = parent::getJSFiles();
        $list[] = 'attributes/book/row/attribute/assign_classes/controller.js';

        return $list;
    }

    /**
     * Return button label
     *
     * @return string
     * @see    ____func_see____
     * @since  1.0.0
     */
    protected function getButtonLabel()
    {
        return parent::getButtonLabel() ?: static::t(
            '{{X}} product classes',
            array('X' => count($this->getParam(static::PARAM_ATTRIBUTE)->getClasses()))
        );
    }

    /**
     * Return default value for widget param
     *
     * @return string
     * @see    ____func_see____
     * @since  1.0.16
     */
    protected function getDefaultTarget()
    {
        return 'attribute_assign_classes';
    }

    /**
     * Return default value for widget param
     *
     * @return string
     * @see    ____func_see____
     * @since  1.0.16
     */
    protected function getDefaultWidget()
    {
        return '\XLite\View\Attributes\Book\Row\Attribute\AssignClasses';
    }

    /**
     * Return CSS classes
     *
     * @return string
     * @see    ____func_see____
     * @since  1.0.0
     */
    protected function getClass()
    {
        return parent::getClass() . ' assign-classes-button';
    }
}
