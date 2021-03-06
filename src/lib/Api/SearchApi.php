<?php
/**
 * SearchApi
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

namespace Alfresco\Api;

use \Alfresco\ApiClient;
use \Alfresco\ApiException;
use \Alfresco\Configuration;
use \Alfresco\ObjectSerializer;

/**
 * SearchApi Class Doc Comment
 *
 * @category Class
 * @package  Alfresco
 * @author   Rhuan Barreto
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class SearchApi
{
    /**
     * API Client
     *
     * @var \Alfresco\ApiClient instance of the ApiClient
     */
    protected $apiClient;

    /**
     * Constructor
     *
     * @param \Alfresco\ApiClient|null $apiClient The api client to use
     */
    public function __construct(\Alfresco\ApiClient $apiClient = null)
    {
        if ($apiClient === null) {
            $apiClient = new ApiClient();
        }
        $this->apiClient = $apiClient;
    }

    /**
     * Get API client
     *
     * @return \Alfresco\ApiClient get the API client
     */
    public function getApiClient()
    {
        return $this->apiClient;
    }

    /**
     * Set the API client
     *
     * @param \Alfresco\ApiClient $apiClient set the API client
     *
     * @return SearchApi
     */
    public function setApiClient(\Alfresco\ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        return $this;
    }

    /**
     * Operation search
     *
     * Searches Alfresco
     *
     * @param \Alfresco\Model\SearchRequest $query_body Generic query API (required)
     * @throws \Alfresco\ApiException on non-2xx response
     * @return \Alfresco\Model\ResultSetPaging
     */
    public function search($query_body)
    {
        list($response) = $this->searchWithHttpInfo($query_body);
        return $response;
    }

    /**
     * Operation searchWithHttpInfo
     *
     * Searches Alfresco
     *
     * @param \Alfresco\Model\SearchRequest $query_body Generic query API (required)
     * @throws \Alfresco\ApiException on non-2xx response
     * @return array of \Alfresco\Model\ResultSetPaging, HTTP status code, HTTP response headers (array of strings)
     */
    public function searchWithHttpInfo($query_body)
    {
        // verify the required parameter 'query_body' is set
        if ($query_body === null) {
            throw new \InvalidArgumentException('Missing the required parameter $query_body when calling search');
        }
        // parse inputs
        $resourcePath = "/search";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/json']);

        // body params
        $_tempBody = null;
        if (isset($query_body)) {
            $_tempBody = $query_body;
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires HTTP basic authentication
        if (strlen($this->apiClient->getConfig()->getUsername()) !== 0 or strlen($this->apiClient->getConfig()->getPassword()) !== 0) {
            $headerParams['Authorization'] = 'Basic ' . base64_encode($this->apiClient->getConfig()->getUsername() . ":" . $this->apiClient->getConfig()->getPassword());
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'POST',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Alfresco\Model\ResultSetPaging',
                '/search'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Alfresco\Model\ResultSetPaging', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Alfresco\Model\ResultSetPaging', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Alfresco\Model\Error', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    public function getUrl()
    {
        return $this->getApiClient()->getConfig()->getHost() .'/-default-/public/search/versions/1';
    }
}
