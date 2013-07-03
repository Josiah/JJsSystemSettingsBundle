<?php
/**
 * @package   JJsSystemSettingsBundle
 * @copyright © 2013 Josiah Truasheim <josiah@jjs.id.au>
 * @license   http://josiah.github.io/JJsSystemSettingsBundle/LICENSE.html MIT
 * @link      http://josiah.github.io/JJsSystemSettingsBundle/Settings/SettingInterface.html
 */
namespace JJs\Bundle\SystemSettingsBundle\Setting;

use Symfony\Component\OptionsResolver\Options;
use Closure;

/**
 * String Setting
 *
 * Simple settings which are stored as strings can be configured using this
 * class.
 *
 * @author Josiah <josiah@jjs.id.au>
 */
class StringSetting implements SettingInterface
{
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
        return $string;
    }

    /**
     * Returns the normal value converted to a string
     * 
     * @param string $normal Normal value to convert to a string
     * @return string
     */
    public function getStringValue($normal)
    {
        return (string) $normal;
    }
}