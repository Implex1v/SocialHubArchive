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

    /**
     * Reads the latest <code>$count</code> tweets of the given user
     * @param $username string The official name of the twitter user
     * @param $count int The number of latest tweets to read
     * @return string|null The response as builder string or null if request failed
     */
    public function readFeed($username, $count) {
        if(!$username) {
            throw new RuntimeException("username is null");
        }

        if(!$count) {
            throw new RuntimeException("count is null");
        }

        $dao = new ApiDAOImpl();
        $twitter = $dao->readByName("Twitter");
        if($twitter) {
            $client = new RESTClient();
            $client->setUrl("https://api.twitter.com/1.1/statuses/user_timeline.json");
            $client->addQueryParam("screen_name", $username);
            $client->addQueryParam("count", $count);
            $client->addHeaderParam("Authorization", "Bearer " . $twitter->getToken());

            $result = $client->run();
            if($result) {
                return $result;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    /**
     * Saves the given bear token into the database if there is no twitter entry yet
     * @param array $result The result of the twitter api call
     */
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