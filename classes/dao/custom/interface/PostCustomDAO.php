<?php

interface PostCustomDAO {
    function postExits($creatorId, $originalId, $channel);
    function readLatestPostsOf($creatorId, $count);
    function readPosts($creatorId, $timestamp);
}
