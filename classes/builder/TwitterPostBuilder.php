<?php

class TwitterPostBuilder {
    /**
     * Returns a list of Post objects which contains all data to display the tweet. The tweets are persisted
     * @param Creator $creator The creator of the tweets
     * @param $response string The builder response string of twitter api call
     * @return array An array containing the post or an empty array if an error occurred
     */
    function buildTwitterPosts(Creator $creator, $response) {
        if(!$response) {
            throw new RuntimeException("response is null");
        }

        $tweets = json_decode($response, true);
        if(is_array($tweets) AND ! array_key_exists("error", $tweets)) {
            $list = array();

            for($i = 0; $i < sizeof($tweets); $i++) {
                $tweet = $this->buildTwitterPost($creator, $tweets[$i]);
                if($tweet) {
                    $list[] = $tweet;
                }
            }

            return $list;
        } else {
            return array();
        }
    }

    private function buildTwitterPost(Creator $creator, array $t) {
        $dao = new PostDAOImpl();

        if(! $dao->postExits($creator->getId(), $t['id_str'])) {
            $tweet = new Post();
            $tweet->setContent($t['text']);
            $tweet->setReleased($this->decodeDatetime($t['created_at']));
            $tweet->setChannel("Twitter");
            $tweet->setOriginalId($t['id_str']);
            $tweet->setLink($this->buildTwitterLink($creator->getTwitterId(), $t['id_str']));
            $tweet->setCreatorId($creator->getId());

            var_dump($creator);

            $tweet = $dao->create($tweet);

            var_dump($tweet);

            return $tweet;
        } else {
            return null;
        }
    }

    /**
     * Decodes twitters special datetime format into the sql's one
     * @param $twitterDatetime string The twitter datetime
     * @return string The formatted datetime
     */
    private function decodeDatetime($twitterDatetime) {
        $dt = DateTime::createFromFormat("D M j H:i:s P Y", $twitterDatetime);
        return $dt->format("Y-m-d H:i:s");
    }

    /**
     * Returns the link to the tweet with the given id
     * @param $username string The name of the creator of the tweed
     * @param $id string The id of the tweet
     * @return string The link to the tweet
     */
    private function buildTwitterLink($username, $id) {
        return "https://twitter.com/".$username."/status/".$id;
    }
}