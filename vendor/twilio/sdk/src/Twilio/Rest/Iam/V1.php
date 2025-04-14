<?php
/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Iam
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\Iam;

use Twilio\Domain;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\Rest\Iam\V1\ApiKeyList;
use Twilio\Rest\Iam\V1\GetApiKeysList;
use Twilio\Rest\Iam\V1\NewApiKeyList;
use Twilio\Rest\Iam\V1\TokenList;
use Twilio\Version;

/**
 * @property ApiKeyList $apiKey
 * @property GetApiKeysList $getApiKeys
 * @property NewApiKeyList $newApiKey
 * @property TokenList $token
 * @method \Twilio\Rest\Iam\V1\ApiKeyContext apiKey(string $sid)
 */
class V1 extends Version
{
    protected $_apiKey;
    protected $_getApiKeys;
    protected $_newApiKey;
    protected $_token;

    /**
     * Construct the V1 version of Iam
     *
     * @param Domain $domain Domain that contains the version
     */
    public function __construct(Domain $domain)
    {
        parent::__construct($domain);
        $this->version = 'v1';
    }

    protected function getApiKey(): ApiKeyList
    {
        if (!$this->_apiKey) {
            $this->_apiKey = new ApiKeyList($this);
        }
        return $this->_apiKey;
    }

    protected function getGetApiKeys(): GetApiKeysList
    {
        if (!$this->_getApiKeys) {
            $this->_getApiKeys = new GetApiKeysList($this);
        }
        return $this->_getApiKeys;
    }

    protected function getNewApiKey(): NewApiKeyList
    {
        if (!$this->_newApiKey) {
            $this->_newApiKey = new NewApiKeyList($this);
        }
        return $this->_newApiKey;
    }

    protected function getToken(): TokenList
    {
        if (!$this->_token) {
            $this->_token = new TokenList($this);
        }
        return $this->_token;
    }

    /**
     * Magic getter to lazy load root resources
     *
     * @param string $name Resource to return
     * @return \Twilio\ListResource The requested resource
     * @throws TwilioException For unknown resource
     */
    public function __get(string $name)
    {
        $method = 'get' . \ucfirst($name);
        if (\method_exists($this, $method)) {
            return $this->$method();
        }

        throw new TwilioException('Unknown resource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call(string $name, array $arguments): InstanceContext
    {
        $property = $this->$name;
        if (\method_exists($property, 'getContext')) {
            return \call_user_func_array(array($property, 'getContext'), $arguments);
        }

        throw new TwilioException('Resource does not have a context');
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        return '[Twilio.Iam.V1]';
    }
}
