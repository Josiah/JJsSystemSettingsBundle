<?php
/**
 * @package   JJsSystemSettingsBundle
 * @copyright © 2013 Josiah Truasheim <josiah@jjs.id.au>
 * @license   http://josiah.github.io/JJsSystemSettingsBundle/LICENSE.html MIT
 * @link      http://josiah.github.io/JJsSystemSettingsBundle/Settings/SettingInterface.html
 */
namespace JJs\Bundle\SystemSettingsBundle\Setting;

/**
 * Boolean Setting
 *
 * Boolean settings only have two values - true and false. These settings can be
 * stored in the database using a variety of string values, however they resolve
 * back to a boolean value every time and are never normalized to any other
 * value.
 *
 * @author Josiah <josiah@jjs.id.au>
 */
class BooleanSetting extends Setting
{
    /**
     * Used to represent 'true' values as a string
     *
     * The full list of 'trueish' values will be looked up when normalizing
     * values, however this string will be used when denormalizing boolean
     * values back to strings.
     * 
     * @var string
     */
    protected $trueString;

    /**
     * Used to represent 'false' values as a string
     *
     * The full list of 'falsey' values will be looked up when normalizing
     * values, however this string will be used when denormalizing boolean
     * values back to strings.
     * 
     * @var string
     */
    protected $falseString;

    /**
     * True/false string mapping list
     *
     * Provides a mapping between string values and true or false values which
     * those string denote.
     * 
     * @var array
     */
    protected $stringMapping = [
        '1'         => true, '0'           => false,
        'true'      => true, 'false'       => false,
        'yes'       => true, 'no'          => false,
        'on'        => true, 'off'         => false,
        'enabled'   => true, 'disabled'    => false,
        'active'    => true, 'inactive'    => false,
        'activated' => true, 'deactivated' => false,
    ];

    /**
     * @param string     $name       name of the setting
     * @param string     $true       string for true values
     * @param string     $false      string for false values
     * @param boolean    $default    default value of the setting
     * @param Constraint $constraint validation constraint for this setting
     */
    public function __construct($name, $true = null, $false = null, $default = false, Constraint $constraint = null)
    {
        $this->setStringValues($true ?: 'true', $false ?: 'false');

        parent::__construct($name, $default, $constraint);
    }

    /**
     * Returns the string which is used when the value is true
     * 
     * @return string
     */
    public function getTrueString()
    {
        return $this->trueString;
    }

    /**
     * Returns the string which is used when the value is false
     * 
     * @return string
     */
    public function getFalseSetring()
    {
        return $this->falseString;
    }

    /**
     * Sets the string values used for `true` and `false` when storing settings
     * 
     * @param string $true value for true
     * @param string $false value for false
     */
    public function setStringValues($true, $false)
    {
        $true  = strtolower($true);
        $false = strtolower($false);

        if ($true === $false) {
            throw new InvalidArgumentException(sprintf(
                "You cannot have a boolean setting with the same value for true and false. '%s' was passed for both.",
                $true
            ));
        }

        $this->stringMapping[$true]  = true;
        $this->stringMapping[$false] = false;

        $this->trueString = $true;
        $this->falseString = $false;

        return $this;
    }

    /**
     * Returns the value which was passed without further modification
     *
     * String settings are stored as strings and don't require normalization
     * when extracted.
     * 
     * @param Options $settings Reference to other normalized settings
     * @param string  $string   String for normalization
     * @return string
     */
    public function getNormalValue(Options $settings, $string)
    {
        $string = strtolower($string);

        if (array_key_exists($string, $this->stringMapping)) {
            return $this->stringMapping[$string];
        } else {
            return $this->getDefault($settings);
        }
    }

    /**
     * Returns the normal value converted to a string
     * 
     * @param string $normal Normal value to convert to a string
     * @return string
     */
    public function getStringValue($normal)
    {
        return $normal ? $this->trueString : $this->falseString;
    }
}