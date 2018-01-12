<?php

class RESTClient {
    private $url;
    private $header;
    private $body;
    private $query;
    private $method;

    /**
     * RESTClient constructor.
     */
    public function __construct() {
        $this->body = array();
        $this->header = array();
        $this->query = array();
    }

    public function addHeaderParam($key, $value) {
        $this->header[$key] = $value;
    }

    public function addBodyParam($key, $value) {
        $this->body[$key] = $value;
    }

    public function addQueryParam($key, $value) {
        $this->query[$key] = $value;
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
        if ($this->url) {
            if(sizeof($this->query) > 0) {
                $this->url .= "?" . http_build_query($this->query);
            }

            $curl = curl_init($this->url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $this->buildHeader());
            curl_setopt($curl, CURLINFO_HEADER_OUT, true);

            if($this->method == CURLOPT_POST) {
                curl_setopt($curl, $this->method, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $this->body);
            }

            $result = curl_exec($curl);
            $info = curl_getinfo($curl);
            file_put_contents(__DIR__ . "log.log", print_r($info, true), true);

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