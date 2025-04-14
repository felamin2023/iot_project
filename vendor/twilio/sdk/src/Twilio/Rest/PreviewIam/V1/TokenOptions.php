<?php
/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Organization Public API
 * No description provided (generated by Openapi Generator https://github.com/openapitools/openapi-generator)
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\PreviewIam\V1;

use Twilio\Options;
use Twilio\Values;

abstract class TokenOptions
{
    /**
     * @param string $clientSecret The credential for confidential OAuth App.
     * @param string $code JWT token related to the authorization code grant type.
     * @param string $redirectUri The redirect uri
     * @param string $audience The targeted audience uri
     * @param string $refreshToken JWT token related to refresh access token.
     * @param string $scope The scope of token
     * @return CreateTokenOptions Options builder
     */
    public static function create(
        
        string $clientSecret = Values::NONE,
        string $code = Values::NONE,
        string $redirectUri = Values::NONE,
        string $audience = Values::NONE,
        string $refreshToken = Values::NONE,
        string $scope = Values::NONE

    ): CreateTokenOptions
    {
        return new CreateTokenOptions(
            $clientSecret,
            $code,
            $redirectUri,
            $audience,
            $refreshToken,
            $scope
        );
    }

}

class CreateTokenOptions extends Options
    {
    /**
     * @param string $clientSecret The credential for confidential OAuth App.
     * @param string $code JWT token related to the authorization code grant type.
     * @param string $redirectUri The redirect uri
     * @param string $audience The targeted audience uri
     * @param string $refreshToken JWT token related to refresh access token.
     * @param string $scope The scope of token
     */
    public function __construct(
        
        string $clientSecret = Values::NONE,
        string $code = Values::NONE,
        string $redirectUri = Values::NONE,
        string $audience = Values::NONE,
        string $refreshToken = Values::NONE,
        string $scope = Values::NONE

    ) {
        $this->options['clientSecret'] = $clientSecret;
        $this->options['code'] = $code;
        $this->options['redirectUri'] = $redirectUri;
        $this->options['audience'] = $audience;
        $this->options['refreshToken'] = $refreshToken;
        $this->options['scope'] = $scope;
    }

    /**
     * The credential for confidential OAuth App.
     *
     * @param string $clientSecret The credential for confidential OAuth App.
     * @return $this Fluent Builder
     */
    public function setClientSecret(string $clientSecret): self
    {
        $this->options['clientSecret'] = $clientSecret;
        return $this;
    }

    /**
     * JWT token related to the authorization code grant type.
     *
     * @param string $code JWT token related to the authorization code grant type.
     * @return $this Fluent Builder
     */
    public function setCode(string $code): self
    {
        $this->options['code'] = $code;
        return $this;
    }

    /**
     * The redirect uri
     *
     * @param string $redirectUri The redirect uri
     * @return $this Fluent Builder
     */
    public function setRedirectUri(string $redirectUri): self
    {
        $this->options['redirectUri'] = $redirectUri;
        return $this;
    }

    /**
     * The targeted audience uri
     *
     * @param string $audience The targeted audience uri
     * @return $this Fluent Builder
     */
    public function setAudience(string $audience): self
    {
        $this->options['audience'] = $audience;
        return $this;
    }

    /**
     * JWT token related to refresh access token.
     *
     * @param string $refreshToken JWT token related to refresh access token.
     * @return $this Fluent Builder
     */
    public function setRefreshToken(string $refreshToken): self
    {
        $this->options['refreshToken'] = $refreshToken;
        return $this;
    }

    /**
     * The scope of token
     *
     * @param string $scope The scope of token
     * @return $this Fluent Builder
     */
    public function setScope(string $scope): self
    {
        $this->options['scope'] = $scope;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.PreviewIam.V1.CreateTokenOptions ' . $options . ']';
    }
}

