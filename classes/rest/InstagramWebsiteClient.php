<?php

class InstagramWebsiteClient {
    public function getLatestImages(Creator $creator, $count = 10) {
        if(!$creator) {
            throw new RuntimeException("username is null");
        }

        $array = $this->getJSONData($creator->getInstagramId());
        if($array) {
            $entries = $array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];

            $list = array();
            for($i = 0; $i < sizeof($entries); $i++) {
                echo $i."<br>";
                $entry = $this->parsePost($creator, $entries[$i]);
                if($entry) {
                    $list[] = $entry;
                }
            }

            return $entries;
        } else {
            return null;
        }
    }

    /**
     * Parses und builds a post from the instagram json array. This method adds an entry to the database and returns the result
     * @param Creator $creator The creator of the content
     * @param $entry string The entry in the json array
     * @return null|Post The persisted post or null if an error occurred
     */
    private function parsePost(Creator $creator, $entry) {
        $dao = new PostDAOImpl();

        if(! $dao->postExits($creator->getId(), $entry['code'], "Instagram")) {
            echo "post does not exist";

            $post = new Post();
            $post->setReleased(date("Y-m-d H:i:s", $entry['date']));
            $post->setOriginalId($entry['code']);
            $post->setCreatorId($creator->getId());
            $post->setChannel("Instagram");
            $post->setContent($entry['thumbnail_src']);
            $post->setComment(utf8_decode($entry['caption']));
            $post->setLink($this->buildLink($entry['code']));
            $post = $dao->create($post);

            if($post) {
                return $post;
            } else {
                return null;
            }
        } else {
            echo "post does exist";
            return null;
        }
    }

    /**
     * Returns the json array containing all post data
     * @param $username string The instagram username
     * @return array An array containing all post data
     */
    private function getJSONData($username) {
        $src = file_get_contents("https://instagram.com/" . $username);
        $elements = explode("window._sharedData = ", $src);
        $json = explode(';</script>', $elements[1]);
        $array = json_decode($json[0], true);
        return $array;
    }

    private function buildLink($id) {
        return "https://www.instagram.com/p/" . $id . "/";
    }
}