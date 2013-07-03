<?php
/**
 * @package   JJsSystemSettingsBundle
 * @copyright © 2013 Josiah Truasheim <josiah@jjs.id.au>
 * @license   http://josiah.github.io/JJsSystemSettingsBundle/LICENSE.html MIT
 * @link      http://josiah.github.io/JJsSystemSettingsBundle/Settings/SettingInterface.html
 */
namespace JJs\Bundle\SystemSettingsBundle\Setting;

/**
 * Setting
 *
 * @author Josiah <josiah@jjs.id.au>
 */
abstract class Setting implements SettingInterface
{
    /**
     * @see $this->getName()
     * @var string
     */
    protected $name;

    /**
     * Provides a default value for when no setting is present in the database.
     *
     * - When set to a `string` the default will be used as the literal default
     *   value.
     * - When set to a `Closure` it will be executed with the same arguments as
     *   the [`getDefault()` method](#getdefault-method) and the returned vaule
     *   will be used as the default for the setting.
     * 
     * @var string|Closure
     */
    protected $default;

    /**
     * Defines a constraint which this setting must adhere to
     * 
     * @var Constraint
     */
    protected $constraint;

    /**
     * @param string $name
     *        Name given to the setting, assigned to the
     *        [`name` property](#name-property).
     * @param string $default
     *        Default value of the setting, assigned to the
     *        [`default` property](#default-property). Defaults to an empty
     *        string `''`.
     * @param Constraint $constraint
     *        The validation constraint which the value must satisfy when it is
     *        updated in the configuration store. Assigned to the
     *        [`constraint` property](#constraint-property)
     */
    public function __construct($name, $default = null, Constraint $constraint = null)
    {
        $this->name       = $name;
        $this->default    = $default;
        $this->constraint = $constraint;
    }

    /**
     * @see SettingInterface->getName
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the default value of this setting
     * 
     * @see $this->default for the types of defaults which can be specified
     * @param Options $settings Reference to existing settings on which this
     *                          value may be dependant.
     * @return string
     */
    public function getDefault(Options $settings)
    {
        $default = $this->default;

        // * The default value can be a closure, in which case it should be
        //   executed to derive the default value based on other settings.
        if ($default instanceof Closure) return $default($settings);

        return $default;
    }

    /**
     * Returns the validation constraint which this setting must adhere to
     * 
     * @return Constraint|null
     */
    public function getConstraint()
    {
        return $this->constraint;
    }
}