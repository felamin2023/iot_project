<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Microvisor
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Microvisor\V1\Device;

use Twilio\Exceptions\TwilioException;
use Twilio\Values;
use Twilio\Version;
use Twilio\InstanceContext;


class DeviceSecretContext extends InstanceContext
    {
    /**
     * Initialize the DeviceSecretContext
     *
     * @param Version $version Version that contains the resource
     * @param string $deviceSid A 34-character string that uniquely identifies the Device.
     * @param string $key The secret key; up to 100 characters.
     */
    public function __construct(
        Version $version,
        $deviceSid,
        $key
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        'deviceSid' =>
            $deviceSid,
        'key' =>
            $key,
        ];

        $this->uri = '/Devices/' . \rawurlencode($deviceSid)
        .'/Secrets/' . \rawurlencode($key)
        .'';
    }

    /**
     * Delete the DeviceSecretInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool
    {

        $headers = Values::of(['Content-Type' => 'application/x-www-form-urlencoded' ]);
        return $this->version->delete('DELETE', $this->uri, [], [], $headers);
    }


    /**
     * Fetch the DeviceSecretInstance
     *
     * @return DeviceSecretInstance Fetched DeviceSecretInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): DeviceSecretInstance
    {

        $headers = Values::of(['Content-Type' => 'application/x-www-form-urlencoded', 'Accept' => 'application/json' ]);
        $payload = $this->version->fetch('GET', $this->uri, [], [], $headers);

        return new DeviceSecretInstance(
            $this->version,
            $payload,
            $this->solution['deviceSid'],
            $this->solution['key']
        );
    }


    /**
     * Update the DeviceSecretInstance
     *
     * @param string $value The secret value; up to 4096 characters.
     * @return DeviceSecretInstance Updated DeviceSecretInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(string $value): DeviceSecretInstance
    {

        $data = Values::of([
            'Value' =>
                $value,
        ]);

        $headers = Values::of(['Content-Type' => 'application/x-www-form-urlencoded', 'Accept' => 'application/json' ]);
        $payload = $this->version->update('POST', $this->uri, [], $data, $headers);

        return new DeviceSecretInstance(
            $this->version,
            $payload,
            $this->solution['deviceSid'],
            $this->solution['key']
        );
    }


    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Microvisor.V1.DeviceSecretContext ' . \implode(' ', $context) . ']';
    }
}
