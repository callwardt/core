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
 * @since     1.0.22
 */

namespace XLite\View\FormField\Inline\Base;

/**
 * Single-field
 * 
 * @see   ____class_see____
 * @since 1.0.22
 */
abstract class Single extends \XLite\View\FormField\Inline\AInline
{
    /**
     * Define form field
     *
     * @return string
     * @see    ____func_see____
     * @since  1.0.15
     */
    abstract protected function defineFieldClass();

    /**
     * Define fields
     *
     * @return array
     * @see    ____func_see____
     * @since  1.0.22
     */
    protected function defineFields()
    {
        return array(
            $this->getParam(static::PARAM_FIELD_NAME) => array(
                static::FIELD_NAME  => $this->getParam(static::PARAM_FIELD_NAME),
                static::FIELD_CLASS => $this->defineFieldClass(),
            ),
        );
    }

    /**
     * Get entity value
     *
     * @return mixed
     * @see    ____func_see____
     * @since  1.0.22
     */
    protected function getEntityValue()
    {
        $method = 'get' . ucfirst($this->getParam(static::PARAM_FIELD_NAME));

        // $method assembled from 'get' + field short name
        return $this->getEntity()->$method();
    }

    /**
     * Get field value from entity
     *
     * @param array $field Field
     *
     * @return mixed
     * @see    ____func_see____
     * @since  1.0.22
     */
    protected function getFieldEntityValue(array $field)
    {
        return $this->getEntityValue();
    }

    /**
     * Get single field 
     * 
     * @return array
     * @see    ____func_see____
     * @since  1.0.22
     */
    protected function getSingleField()
    {
        $list = $this->getFields();

        return array_shift($list);
    }

    /**
     * Get single field as widget
     *
     * @return \XLite\View\FormField\AFormField
     * @see    ____func_see____
     * @since  1.0.22
     */
    protected function getSingleFieldAsWidget()
    {
        $field = $this->getSingleField();

        return $field['widget'];
    }

}
