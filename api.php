<?php

class RESTClient {
    private $url;
    private $header;
    private $body;
    private $method;

    /**
     * RESTClient constructor.
     */
    public function __construct() {
        $this->body = array();
        $this->header = array();
    }

    public function addHeaderParam($key, $value) {
        $this->header[$key] = $value;
    }

    public function addBodyParam($key, $value) {
        $this->body[$key] = $value;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url) {
        $this->url = $url;
    }

    public function setPost() {
        $this->method = CURLOPT_POST;
    }

    public function setPut() {
        $this->method = CURLOPT_PUT;
    }

    function run() {
        if($this->url) {
            $curl = curl_init($this->url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $this->buildHeader());

            if($this->method == CURLOPT_POST) {
                curl_setopt($curl, $this->method, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $this->body);
            }

            $result = curl_exec($curl);
            curl_close($curl);

            return $result;
        } else {
            return null;
        }
    }

    private function buildHeader() {
        $header_[] = array();

        foreach ($this->header as $key => $value) {
            $header_[] = $key . ": " . $value;
        }

        return $header_;
    }
}