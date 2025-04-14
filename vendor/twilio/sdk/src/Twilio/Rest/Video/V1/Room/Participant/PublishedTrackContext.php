<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Video
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Video\V1\Room\Participant;

use Twilio\Exceptions\TwilioException;
use Twilio\Values;
use Twilio\Version;
use Twilio\InstanceContext;


class PublishedTrackContext extends InstanceContext
    {
    /**
     * Initialize the PublishedTrackContext
     *
     * @param Version $version Version that contains the resource
     * @param string $roomSid The SID of the Room resource where the Track resource to fetch is published.
     * @param string $participantSid The SID of the Participant resource with the published track to fetch.
     * @param string $sid The SID of the RoomParticipantPublishedTrack resource to fetch.
     */
    public function __construct(
        Version $version,
        $roomSid,
        $participantSid,
        $sid
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        'roomSid' =>
            $roomSid,
        'participantSid' =>
            $participantSid,
        'sid' =>
            $sid,
        ];

        $this->uri = '/Rooms/' . \rawurlencode($roomSid)
        .'/Participants/' . \rawurlencode($participantSid)
        .'/PublishedTracks/' . \rawurlencode($sid)
        .'';
    }

    /**
     * Fetch the PublishedTrackInstance
     *
     * @return PublishedTrackInstance Fetched PublishedTrackInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): PublishedTrackInstance
    {

        $headers = Values::of(['Content-Type' => 'application/x-www-form-urlencoded', 'Accept' => 'application/json' ]);
        $payload = $this->version->fetch('GET', $this->uri, [], [], $headers);

        return new PublishedTrackInstance(
            $this->version,
            $payload,
            $this->solution['roomSid'],
            $this->solution['participantSid'],
            $this->solution['sid']
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
        return '[Twilio.Video.V1.PublishedTrackContext ' . \implode(' ', $context) . ']';
    }
}
