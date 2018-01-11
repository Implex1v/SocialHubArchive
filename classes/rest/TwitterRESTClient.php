<?php

if(! class_exists("RESTClient")) {
    require __DIR__ . "/RESTClient.php";
}

class TwitterRESTClient {

    public function getBearToken() {
        $client = new RESTClient();
        $client->setUrl("https://api.twitter.com/oauth2/token");
        $client->addBodyParam("grant_type", "client_credentials");
        $client->addHeaderParam("Content-Type", "application/x-www-form-urlencoded;charset=UTF-8");
        $client->addHeaderParam("Authorization","Basic bDN1MVBtdnVBRUtBWkZDQ01ob05Rc0RxYTpUOTNFMERiS25xbHRze\nWJNdFNtbFZGRHRYclBsQ0JXd3BCM1o0OHdvRUxleXo4OTV4cg==");
        $client->setPost();

        $result = $client->run();
        if($result) {
            $this->saveBearToken(json_decode($result, true));
        }
    }

    public function readFeed($user, $count) {
        $client = new RESTClient();
        $client->setUrl("https://api.twitter.com/1.1/statuses/user_timeline.json");
        $client->
    }

    private function saveBearToken(array $result) {
        $dao = new ApiDAOImpl();

        if(! $dao->readByName("Twitter")) {
            $api = new Api();
            $api->setUrl("https://api.twitter.com/oauth2/token");
            $api->setName("Twitter");
            $api->setToken($result['access_token']);

            $dao->create($api);
        }
    }
}