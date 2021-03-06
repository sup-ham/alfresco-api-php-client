<?php
/**
 * RequestFacetSet
 *
 * PHP version 5
 *
 * @category Class
 * @package  Alfresco
 * @author   Swaagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Alfresco Content Services REST API
 *
 * **API**  Provides access to the features of Alfresco Content Services.
 *
 * OpenAPI spec version: 1
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Alfresco\Model;

use \ArrayAccess;

/**
 * RequestFacetSet Class Doc Comment
 *
 * @category    Class
 * @description The interval to Set
 * @package     Alfresco
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class RequestFacetSet implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'RequestFacetSet';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'label' => 'string',
        'start' => 'string',
        'end' => 'string',
        'start_inclusive' => 'bool',
        'end_inclusive' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerFormats = [
        'label' => null,
        'start' => null,
        'end' => null,
        'start_inclusive' => null,
        'end_inclusive' => null
    ];

    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = [
        'label' => 'label',
        'start' => 'start',
        'end' => 'end',
        'start_inclusive' => 'startInclusive',
        'end_inclusive' => 'endInclusive'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'label' => 'setLabel',
        'start' => 'setStart',
        'end' => 'setEnd',
        'start_inclusive' => 'setStartInclusive',
        'end_inclusive' => 'setEndInclusive'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'label' => 'getLabel',
        'start' => 'getStart',
        'end' => 'getEnd',
        'start_inclusive' => 'getStartInclusive',
        'end_inclusive' => 'getEndInclusive'
    ];

    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    public static function setters()
    {
        return self::$setters;
    }

    public static function getters()
    {
        return self::$getters;
    }

    

    

    /**
     * Associative array for storing property values
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     * @param mixed[] $data Associated array of property values initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['label'] = isset($data['label']) ? $data['label'] : null;
        $this->container['start'] = isset($data['start']) ? $data['start'] : null;
        $this->container['end'] = isset($data['end']) ? $data['end'] : null;
        $this->container['start_inclusive'] = isset($data['start_inclusive']) ? $data['start_inclusive'] : true;
        $this->container['end_inclusive'] = isset($data['end_inclusive']) ? $data['end_inclusive'] : true;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];

        return $invalid_properties;
    }

    /**
     * validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {

        return true;
    }


    /**
     * Gets label
     * @return string
     */
    public function getLabel()
    {
        return $this->container['label'];
    }

    /**
     * Sets label
     * @param string $label A label to use to identify the set
     * @return $this
     */
    public function setLabel($label)
    {
        $this->container['label'] = $label;

        return $this;
    }

    /**
     * Gets start
     * @return string
     */
    public function getStart()
    {
        return $this->container['start'];
    }

    /**
     * Sets start
     * @param string $start The start of the range
     * @return $this
     */
    public function setStart($start)
    {
        $this->container['start'] = $start;

        return $this;
    }

    /**
     * Gets end
     * @return string
     */
    public function getEnd()
    {
        return $this->container['end'];
    }

    /**
     * Sets end
     * @param string $end The end of the range
     * @return $this
     */
    public function setEnd($end)
    {
        $this->container['end'] = $end;

        return $this;
    }

    /**
     * Gets start_inclusive
     * @return bool
     */
    public function getStartInclusive()
    {
        return $this->container['start_inclusive'];
    }

    /**
     * Sets start_inclusive
     * @param bool $start_inclusive When true, the set will include values greater or equal to \"start\"
     * @return $this
     */
    public function setStartInclusive($start_inclusive)
    {
        $this->container['start_inclusive'] = $start_inclusive;

        return $this;
    }

    /**
     * Gets end_inclusive
     * @return bool
     */
    public function getEndInclusive()
    {
        return $this->container['end_inclusive'];
    }

    /**
     * Sets end_inclusive
     * @param bool $end_inclusive When true, the set will include values less than or equal to \"end\"
     * @return $this
     */
    public function setEndInclusive($end_inclusive)
    {
        $this->container['end_inclusive'] = $end_inclusive;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     * @param  integer $offset Offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     * @param  integer $offset Offset
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     * @param  integer $offset Offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(\Alfresco\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        }

        return json_encode(\Alfresco\ObjectSerializer::sanitizeForSerialization($this));
    }
}


