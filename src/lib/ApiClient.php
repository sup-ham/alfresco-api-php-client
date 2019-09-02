<?php
/**
 * ApiClient
 *
 * PHP version 5
 *
 * @category Class
 * @package  Alfresco
 * @author   Rhuan Barreto
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

namespace Alfresco;

defined('JSON_UNESCAPED_LINE_TERMINATORS') or define(JSON_UNESCAPED_LINE_TERMINATORS, 2048);
/**
 * ApiClient Class Doc Comment
 *
 * @category Class
 * @package  Alfresco
 * @author   Rhuan Barreto
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ApiClient
{
    public static $PATCH = "PATCH";
    public static $POST = "POST";
    public static $GET = "GET";
    public static $HEAD = "HEAD";
    public static $OPTIONS = "OPTIONS";
    public static $PUT = "PUT";
    public static $DELETE = "DELETE";

    public $api;

    /**
     * Configuration
     *
     * @var Configuration
     */
    protected $config;

    /**
     * Object Serializer
     *
     * @var ObjectSerializer
     */
    protected $serializer;

    /**
     * Constructor of the class
     *
     * @param Configuration $config config for this ApiClient
     */
    public function __construct(\Alfresco\Configuration $config = null)
    {
        if ($config === null) {
            $config = Configuration::getDefaultConfiguration();
        }

        $this->config = $config;
        $this->serializer = new ObjectSerializer();
    }

    /**
     * Get the config
     *
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set the config to the Search API
     *
     * @return $this
     * @deprecated
     */
    public function setSearchApiConfig()
    {
        $this->config->setSearchApi();
        return $this;
    }

    /**
     * Get the serializer
     *
     * @return ObjectSerializer
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * Get API key (with prefix if set)
     *
     * @param  string $apiKeyIdentifier name of apikey
     *
     * @return string API key with the prefix
     */
    public function getApiKeyWithPrefix($apiKeyIdentifier)
    {
        $prefix = $this->config->getApiKeyPrefix($apiKeyIdentifier);
        $apiKey = $this->config->getApiKey($apiKeyIdentifier);

        if (!isset($apiKey)) {
            return null;
        }

        if (isset($prefix)) {
            $keyWithPrefix = $prefix." ".$apiKey;
        } else {
            $keyWithPrefix = $apiKey;
        }

        return $keyWithPrefix;
    }

    /**
     * Make the HTTP call (Sync)
     *
     * @param string $resourcePath path to method endpoint
     * @param string $method       method to call
     * @param array  $queryParams  parameters to be place in query URL
     * @param array  $postData     parameters to be placed in POST body
     * @param array  $headers parameters to be place in request header
     * @param string $responseType expected response type of the endpoint
     * @param string $endpointPath path to method endpoint before expanding parameters
     *
     * @throws \Alfresco\ApiException on a non 2xx response
     * @return mixed
     */
    public function callApi($resourcePath, $method, $queryParams, $postData, $headers, $responseType = null, $endpointPath = null)
    {
        $curl = curl_init();

        // construct the http header
        $headers = array_merge(
            (array)$this->config->getDefaultHeaders(),
            (array)$headers
        );

        // form data
        if ($postData)
        {
          $contentType = $headers['Content-Type'];
          if ($contentType === 'application/x-www-form-urlencoded') {
            $postData = http_build_query($postData);

          } elseif ($contentType !== 'multipart/form-data') {
            // json model
            $postData['auto_rename'] = null;
            $postData = json_encode(\Alfresco\ObjectSerializer::sanitizeForSerialization($postData), JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_LINE_TERMINATORS|JSON_UNESCAPED_UNICODE);

          } else {
            //if ($postData['file_data'] instanceof \CURLFile) {
              //$_postData = [];
              //foreach ($postData::attributeMap() as $key => $postField) {
              //    $_postData[$postField] = is_bool($postData[$key]) ? 'true' : $postData[$key];
              //}
              //$postData = $_postData;
            //} else {
              list($postData, $contentType) = $this->buildMultipartFormdata($postData);
              $headers['Content-Type'] = $contentType;
            //}
          }
        }

        if (method_exists($this->api, 'getUrl')) {
            $url = $this->api->getUrl();
        } else {
            $url = $this->config->getApiUrl();
        }
        $url .= $resourcePath;

        // set timeout, if needed
        if ($this->config->getCurlTimeout() !== 0) {
            curl_setopt($curl, CURLOPT_TIMEOUT, $this->config->getCurlTimeout());
        }
        // set connect timeout, if needed
        if ($this->config->getCurlConnectTimeout() != 0) {
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $this->config->getCurlConnectTimeout());
        }

        // return the result on success, rather than just true
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        foreach ($headers as $key => $val) {
            $headers[] = "$key: $val";
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        // disable SSL verification, if needed
        if ($this->config->getSSLVerification() === false) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        }

        if ($this->config->getCurlProxyHost()) {
            curl_setopt($curl, CURLOPT_PROXY, $this->config->getCurlProxyHost());
        }

        if ($this->config->getCurlProxyPort()) {
            curl_setopt($curl, CURLOPT_PROXYPORT, $this->config->getCurlProxyPort());
        }

        if ($this->config->getCurlProxyType()) {
            curl_setopt($curl, CURLOPT_PROXYTYPE, $this->config->getCurlProxyType());
        }

        if ($this->config->getCurlProxyUser()) {
            curl_setopt($curl, CURLOPT_PROXYUSERPWD, $this->config->getCurlProxyUser() . ':' .$this->config->getCurlProxyPassword());
        }

        if (!empty($queryParams)) {
            $url = ($url . '?' . http_build_query($queryParams));
        }

        if ($this->config->getAllowEncoding()) {
            curl_setopt($curl, CURLOPT_ENCODING, '');
        }

        if (is_resource($postData)) {
            curl_setopt($curl, CURLOPT_PUT, 1);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($curl, CURLOPT_INFILE, $postData);

        } else {
            if ($method === self::$POST) {
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
            } elseif ($method === self::$HEAD) {
                curl_setopt($curl, CURLOPT_NOBODY, true);
            } elseif ($method === self::$OPTIONS) {
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "OPTIONS");
                curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
            } elseif ($method === self::$PATCH) {
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
                curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
            } elseif ($method === self::$PUT) {
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
            } elseif ($method === self::$DELETE) {
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
            } elseif ($method !== self::$GET) {
                throw new ApiException('Method ' . $method . ' is not recognized.');
            }
        }
        curl_setopt($curl, CURLOPT_URL, $url);

        // Set user agent
        curl_setopt($curl, CURLOPT_USERAGENT, $this->config->getUserAgent());

        // debugging for curl
        if ($this->config->getDebug()) {
            if (is_resource($postData)) {
              $debugData = stream_get_contents($postData);
              rewind($postData);
            } else {
              $debugData = $postData;
            }

            error_log("[DEBUG] HTTP Request body  ~BEGIN~".PHP_EOL.print_r($debugData, true).PHP_EOL."~END~".PHP_EOL, 3, $this->config->getDebugFile());

            curl_setopt($curl, CURLOPT_VERBOSE, 1);
            curl_setopt($curl, CURLOPT_STDERR, fopen($this->config->getDebugFile(), 'a'));
        } else {
            curl_setopt($curl, CURLOPT_VERBOSE, 0);
        }

        // obtain the HTTP response headers
        curl_setopt($curl, CURLOPT_HEADER, 1);

        // Make the request
        $response = curl_exec($curl);
        is_resource($postData) && fclose($postData);

        $http_header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $http_header = $this->httpParseHeaders(substr($response, 0, $http_header_size));
        $http_body = substr($response, $http_header_size);
        $response_info = curl_getinfo($curl);

        // debug HTTP response body
        if ($this->config->getDebug()) {
            error_log("[DEBUG] HTTP Response body ~BEGIN~".PHP_EOL.print_r($http_body, true).PHP_EOL."~END~".PHP_EOL, 3, $this->config->getDebugFile());
        }

        // Handle the response
        if ($response_info['http_code'] === 0) {
            $curl_error_message = curl_error($curl);

            // curl_exec can sometimes fail but still return a blank message from curl_error().
            if (!empty($curl_error_message)) {
                $error_message = "API call to $url failed: $curl_error_message";
            } else {
                $error_message = "API call to $url failed, but for an unknown reason. " .
                    "This could happen if you are disconnected from the network.";
            }

            $exception = new ApiException($error_message, 0, null, null);
            $exception->setResponseObject($response_info);
            throw $exception;
        } elseif ($response_info['http_code'] >= 200 && $response_info['http_code'] <= 299) {
            // return raw body if response is a file
            if ($responseType === '\SplFileObject' || $responseType === 'string') {
                return [$http_body, $response_info['http_code'], $http_header];
            }

            $data = json_decode($http_body);
            if (json_last_error() > 0) { // if response is a string
                $data = $http_body;
            }
        } else {
            $data = json_decode($http_body);
            if (json_last_error() > 0) { // if response is a string
                $data = $http_body;
            }

            throw new ApiException(
                "[".$response_info['http_code']."] Error connecting to the API ($url)",
                $response_info['http_code'],
                $http_header,
                $data
            );
        }
        return [$data, $response_info['http_code'], $http_header];
    }

    /**
     * For safe multipart POST request for PHP5.3 ~ PHP 5.4.
     *
     * @param object $data
     * @return array [resource, content-type+boundary]
     * @see https://www.php.net/manual/en/class.curlfile.php#115161
     */
    public function buildMultipartFormdata($data) {
        $postDataFile = tmpfile();
        // invalid characters for "name" and "filename"
        $disallow = array("\0", "\"", "\r", "\n");
        $boundary = 'X-------------------------'. sha1(rand(11111, 99999) . time() . uniqid());

        foreach ($data::attributeMap() as $key => $postName) {
            $filename = $type = null;
            $postName = str_replace($disallow, "_", $postName);
            $value = $data[$key];
            fwrite($postDataFile, "--$boundary\r\n");

            if ($value instanceof \CURLFile && is_readable($value->name)) {
              $filename = basename($value->name);
              $type = $value->mime;
              $value = fopen($value->name, 'r');

            } elseif (is_array($value)) {
              $filename = isset($value['filename']) ? $value['filename'] : null;
              $type = isset($value['mime']) ? $value['mime'] : null;
              $value = isset($value['stream']) ? $value['stream'] : null;

            } elseif (is_string($value) && is_file($value) && is_readable($value)) {
              $filename = basename($value);
              $value = fopen($value, 'r');
            }

            if (is_resource($value)) {
              $type && $type = "Content-Type: $type\r\n";
              $filename OR $filename = sha1(rand(11111, 99999) . time() . uniqid());
              fwrite($postDataFile, "Content-Disposition: form-data; name=\"$postName\"; filename=\"$filename\"\r\n$type\r\n");
              stream_copy_to_stream($value, $postDataFile);
              fclose($value);

            } else {
              is_bool($value) && $value = $value ? 'true' : 'false';
              fwrite($postDataFile, "Content-Disposition: form-data; name=\"$postName\"\r\n\r\n$value");
            }
            fwrite($postDataFile, "\r\n");
        }

        // add final boundary
        fwrite($postDataFile, "--$boundary--");
        rewind($postDataFile);
        $type = "multipart/form-data; boundary=\"$boundary\"";

        return [$postDataFile, $type];
    }

    /**
     * Return the header 'Accept' based on an array of Accept provided
     *
     * @param string[] $accept Array of header
     *
     * @return string Accept (e.g. application/json)
     */
    public function selectHeaderAccept($accept)
    {
        if (count($accept) === 0 or (count($accept) === 1 and $accept[0] === '')) {
            return null;
        } elseif (preg_grep("/application\/json/i", $accept)) {
            return 'application/json';
        } else {
            return implode(',', $accept);
        }
    }

    /**
     * Return the content type based on an array of content-type provided
     *
     * @param string[] $content_type Array fo content-type
     *
     * @return string Content-Type (e.g. application/json)
     */
    public function selectHeaderContentType($content_type)
    {
        if (count($content_type) === 0 or (count($content_type) === 1 and $content_type[0] === '')) {
            return 'application/json';
        } elseif (preg_grep("/application\/json/i", $content_type)) {
            return 'application/json';
        } else {
            return implode(',', $content_type);
        }
    }

   /**
    * Return an array of HTTP response headers
    *
    * @param string $raw_headers A string of raw HTTP response headers
    *
    * @return string[] Array of HTTP response heaers
    */
    protected function httpParseHeaders($raw_headers)
    {
        // ref/credit: http://php.net/manual/en/function.http-parse-headers.php#112986
        $headers = [];
        $key = '';

        foreach (explode("\n", $raw_headers) as $h) {
            $h = explode(':', $h, 2);

            if (isset($h[1])) {
                if (!isset($headers[$h[0]])) {
                    $headers[$h[0]] = trim($h[1]);
                } elseif (is_array($headers[$h[0]])) {
                    $headers[$h[0]] = array_merge($headers[$h[0]], [trim($h[1])]);
                } else {
                    $headers[$h[0]] = array_merge([$headers[$h[0]]], [trim($h[1])]);
                }

                $key = $h[0];
            } else {
                if (substr($h[0], 0, 1) === "\t") {
                    $headers[$key] .= "\r\n\t".trim($h[0]);
                } elseif (!$key) {
                    $headers[0] = trim($h[0]);
                }
                trim($h[0]);
            }
        }

        return $headers;
    }
}
