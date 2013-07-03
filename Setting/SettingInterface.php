<?php
/**
 * @package   JJsSystemSettingsBundle
 * @copyright © 2013 Josiah Truasheim <josiah@jjs.id.au>
 * @license   http://josiah.github.io/JJsSystemSettingsBundle/LICENSE.html MIT
 * @link      http://josiah.github.io/JJsSystemSettingsBundle/Settings/SettingInterface.html
 */
namespace JJs\Bundle\SystemSettingsBundle\Setting;

/**
 * Setting Interface
 *
 * @author Josiah <josiah@jjs.id.au>
 */
interface SettingInterface
{
    /**
     * Returns the name used to identify the setting
     * 
     * @return string
     */
    public function getName();

    /**
     * Returns the default value of the setting
     *
     * @param Options $settings Provides access to the existing settings so that
     *                          default values can be derived based on other
     *                          settings in the system.
     * @return mixed
     */
    public function getDefault(Options $settings);

    /**
     * Returns the constraint which this setting must satisfy when it is
     * provided by the user
     * 
     * @return Constraint
     */
    public function getConstraint();

    /**
     * Returns a normalized value for the specified setting value
     *
     * The normalized value can be based on the normalized values of other
     * settings. This step is important in the resolution process as setting
     * values are always provided as string values from the database and must
     * be normalized if other native or object types are required.
     * 
     * @param Options $settings Allows for the resolution of other settings to
     *                          assist in the value normalization
     * @param string  $value    Setting value for normalization
     * @return mixed
     */
    public function getNormalValue(Options $settings, $string);

    /**
     * Returns a string value for the specified string value
     * 
     * @param mixed $normal Normal value to convert to a string
     * @return string
     */
    public function getStringValue($normal);
}