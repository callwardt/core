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
 * @copyright  Copyright (c) 2010 Creative Development LLC <info@cdev.ru>. All rights reserved
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @version    SVN: $Id$
 * @link       http://www.litecommerce.com/
 * @see        ____file_see____
 * @since      3.0.0
 */

namespace Includes\Decorator\Plugin\Doctrine\Plugin\Multilangs;

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
     * The replacement pattern
     */
    const PATTERN = '/(.*)(\}.*)/Ss';


    /**
     * List of <file, code> pairs (code replacements)
     * 
     * @var    array
     * @access protected
     * @see    ____var_see____
     * @since  3.0.0
     */
    protected $replacements = array();

    /**
     * Autogenerated "translate" property
     * 
     * @var    string
     * @access protected
     * @see    ____var_see____
     * @since  3.0.0
     */
    protected $translationTemplate = <<<'CODE'
    /**
     * Translations (relation). AUTOGENERATED
     *
     * @var    \Doctrine\Common\Collections\ArrayCollection
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     *
     * @OneToMany (targetEntity="____TRANSLATION_CLASS____", mappedBy="owner", cascade={"persist","remove"})
     */
    protected $translations;
CODE;

    /**
     * Autogenerated getter
     * 
     * @var    string
     * @access protected
     * @see    ____var_see____
     * @since  3.0.0
     */
    protected $getTemplate = <<<'CODE'
    /**
     * Translation getter. AUTOGENERATED
     * 
     * @return string
     * @access public
     * @see    ____func_see____
     * @since  3.0.0
     */
    public function ____GETTER____()
    {
        return $this->getSoftTranslation()->____GETTER____();
    }
CODE;

    /**
     * Autogenerated setter
     *
     * @var    string
     * @access protected
     * @see    ____var_see____
     * @since  3.0.0
     */
    protected $setTemplate = <<<'CODE'
    /**
     * Translation setter. AUTOGENERATED
     *
     * @param string $value value to set
     *
     * @return null
     * @access public
     * @see    ____func_see____
     * @since  3.0.0
     */
    public function ____SETTER____($value)
    {
        return $this->getTranslation($this->editLanguage)->____SETTER____($value);
    }
CODE;

    /**
     * Autogenerated "owner" property
     *
     * @var    string
     * @access protected
     * @see    ____var_see____
     * @since  3.0.0
     */
    protected $ownerTemplate = <<<'CODE'
    /**
     * Translation owner (relation). AUTOGENERATED
     *
     * @var    ____OWNER_CLASS____
     * @access protected
     *
     * @ManyToOne  (targetEntity="____MAIN_CLASS____", inversedBy="translations")
     * @JoinColumn (name="id", referencedColumnName="____MAIN_CLASS_ID____")
     */
    protected $owner;
CODE;


    /**
     * Return list of classes with multilanguage support
     *
     * @return array
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function getMultilangModelClasses()
    {
        return static::getClassesTree()->findByCallback(array($this, 'filterByMultilangParent'));
    }

    /**
     * Remove leading slashes
     *
     * @param string $name class name
     *
     * @return string
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function prepareClassName($name)
    {
        return ltrim($name, '\\');
    }

    /**
     * Get metadata for a class 
     * 
     * @param string $name class name
     *  
     * @return \Doctrine\ORM\Mapping\ClassMetadata
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function getClassMetadata($name)
    {
        return \Includes\Utils\ArrayManager::searchInObjectsArray(
            \Includes\Decorator\Plugin\Doctrine\Utils\EntityManager::getAllMetadata(),
            'name',
            $this->prepareClassName($name)
        );
    }

    /**
     * Substitute entries in code template
     * 
     * @param string $template template to prepare
     * @param array  $entries  list of <entry, value> pairs
     *  
     * @return string
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function substituteTemplate($template, array $entries)
    {
        return str_replace(array_keys($entries), $entries, $this->{$template . 'Template'});
    }

    /**
     * Check if the "translation" field is defined manually
     * 
     * @param string $name class name
     *  
     * @return string
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function getTranslationClass($name)
    {
        $class = null;
        $data  = $this->getClassMetadata($name);

        if (property_exists($data, 'associationMappings') && isset($data->associationMappings['translations'])) {
            $class = '\\' . $data->associationMappings['translations']['targetEntity'];
        }

        return $class;
    }

    /**
     * Return list of the translatabe fields for a class
     *
     * @param string $name class name
     *
     * @return string
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function getTranslationFields($name)
    {
        return array_diff($this->getClassMetadata($name)->fieldNames, $name::getInternalProperties());
    }

    /**
     * Return default name for translation class
     * 
     * @param string $name main class name
     *  
     * @return string
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function getDefaultTranslationClassName($name)
    {
        return $name . 'Translation';
    }

    /**
     * Return list of getters/setters patterns
     * 
     * @return array
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function getAutogeneratedMethodsList()
    {
        return array('get' => '____GETTER____', 'set' => '____SETTER____');
    }

    /**
     * Add code to replace
     * 
     * @param string $class class name
     * @param string $code  code to place
     *  
     * @return null
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function addReplacement($class, $code)
    {
        $file = LC_CLASSES_CACHE_DIR . static::getClassesTree()->find($class)->__get(self::N_FILE_PATH);

        if (!isset($this->replacements[$file])) {
            $this->replacements[$file] = '';
        }

        $this->replacements[$file] .= $code . "\n\n";
    }

    /**
     * Wrapper for the "addReplacement" 
     * 
     * @param string $class       class name
     * @param string $template    template to use
     * @param array  $substitutes list of entries to substitude
     *  
     * @return null
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function replace($class, $template, array $substitutes)
    {
        $this->addReplacement($class, $this->substituteTemplate($template, $substitutes));
    }

    /**
     * Return the array of substitutes for the "translation" template
     * 
     * @param string $name translation class name
     *  
     * @return array
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function getTranslationSubstitutes($name)
    {
        return array(
            '____TRANSLATION_CLASS____' => $this->prepareClassName($name),
        );
    }

    /**
     * Return the array of substitutes for the getters/setters templates
     * 
     * @param string $entry  entry to substitute
     * @param string $method method: "get" or "set"
     * @param string $field  name of field to get or set
     *  
     * @return array
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function getMethodSubstitutes($entry, $method, $field)
    {
        return array(
            $entry => $method . \Includes\Utils\Converter::convertToCamelCase($field),
        );
    }

    /**
     * Return the array of substitutes for the "owner" template
     *
     * @param string $name main class name
     *
     * @return array
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function getOwnerSubstitutes($name)
    {
        return array(
            '____OWNER_CLASS____'   => $name,
            '____MAIN_CLASS____'    => $this->prepareClassName($name),
            '____MAIN_CLASS_ID____' => array_shift($this->getClassMetadata($name)->identifier),
        );
    }

    /**
     * Put prepared code into the files
     * 
     * @return null
     * @access protected
     * @see    ____func_see____
     * @since  3.0.0
     */
    protected function writeData()
    {
        foreach ($this->replacements as $file => $code) {
            \Includes\Utils\FileManager::replace($file, '$1' . $code . '$2', self::PATTERN);
        }
    }


    /**
     * Method to filter multilang classes
     *
     * @param \Includes\Decorator\DataStructure\Node\ClassInfo $node current node
     *
     * @return bool
     * @access public
     * @see    ____func_see____
     * @since  3.0.0
     */
    public function filterByMultilangParent(\Includes\Decorator\DataStructure\Node\ClassInfo $node)
    {
        return in_array('\XLite\Model\Base\I18n', $node->__get(self::N_PARENT_CLASS));
    }

    /**
     * Execute "run" hook handler
     * 
     * @return null
     * @access public
     * @see    ____func_see____
     * @since  3.0.0
     */
    public function executeHookHandlerRun()
    {
        // Children of the "Model\I18n" class
        foreach ($this->getMultilangModelClasses() as $node) {

            // Main and translation class names.
            // E.g. "\XLite\Model\Product" and "\XLite\Model\ProductTranslation"
            $main = $node->__get(self::N_CLASS);
            $translation = $this->getTranslationClass($main);

            // Add the "translation" field to the main class (if not defined manually)
            if (!$translation) {
                $translation = $this->getDefaultTranslationClassName($main);
                $this->replace($main, 'translation', $this->getTranslationSubstitutes($translation));
            }

            // Iterate over all translatable fields
            foreach ($this->getTranslationFields($translation) as $field) {
                // Two iteartions: "getter" and "setter"
                foreach ($this->getAutogeneratedMethodsList() as $method => $entry) {
                    $this->replace($main, $method, $this->getMethodSubstitutes($entry, $method, $field));
                }
            }

            // Add the "owner" field to the main class (if not defined manually)
            if (!property_exists($translation, 'owner')) {
                $this->replace($translation, 'owner', $this->getOwnerSubstitutes($main));
            }
        }

        // Populate changes
        $this->writeData();
    }
}
