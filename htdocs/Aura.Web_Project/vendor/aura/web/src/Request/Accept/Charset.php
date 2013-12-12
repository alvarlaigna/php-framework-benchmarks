<?php
/**
 * 
 * This file is part of Aura for PHP.
 * 
 * @package Aura.Web
 * 
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * 
 */
namespace Aura\Web\Request\Accept;

use Aura\Web\Request\Accept\Value\ValueFactory;

/**
 * 
 * Represents a collection of `Acccept-Charset` header values, sorted in
 * quality order.
 * 
 * @package Aura.Web
 * 
 */
class Charset extends AbstractValues
{
    /**
     * 
     * The $_SERVER key to use when populating acceptable values.
     * 
     * @var string
     * 
     */
    protected $server_key = 'HTTP_ACCEPT_CHARSET';
    
    /**
     * 
     * The type of value object to create using the ValueFactory.
     * 
     * @var string
     * 
     */
    protected $value_type = 'charset';
    
    /**
     * 
     * Constructor.
     * 
     * @param ValueFactory $value_factory A factory for value objects.
     * 
     * @param array $server A copy of $_SERVER for finding acceptable values.
     * 
     */
    public function __construct(
        ValueFactory $value_factory,
        array $server = array()
    ) {
        // parent construction
        parent::__construct($value_factory, $server);
        
        // are charset values specified?
        if (! $this->acceptable) {
            // no, so don't modify anything
            return;
        }
        
        // look for ISO-8859-1, case insensitive
        foreach ($this->acceptable as $charset) {
            if (strtolower($charset->getValue()) == 'iso-8859-1') {
                // found it, no no need to modify
                return;
            }
        }
        
        // charset ISO-8859-1 is acceptable if not explictly mentioned
        $this->add('ISO-8859-1');
    }
}
