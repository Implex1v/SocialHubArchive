<?php

interface PostCustomDAO {
    function postExits($creatorId, $originalId);
    function readLatestPostsOf($creatorId, $count);
}
