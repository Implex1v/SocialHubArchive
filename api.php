<?php

require __DIR__ . "/classes/util/autoload.php";

if($_GET['action']) {
    if($_GET['action'] = "fetch") {
        /* TODO: move to controller
        require __DIR__ . "/classes/rest/TwitterRESTClient.php";
        require __DIR__ . "/classes/builder/TwitterPostBuilder.php";

        $cDao = new CreatorDAOImpl();
        $creator = $cDao->readByName("Gronkh");

        $client = new TwitterRESTClient();
        $result = $client->readFeed($creator->getTwitterId(), 10);

        $builder = new TwitterPostBuilder();
        $cc = $builder->buildTwitterPosts($creator, $result);
        require __DIR__ . "/classes/rest/YouTubeRESTClient.php";
        require __DIR__ . "/classes/builder/YoutubePostBuilder.php";

        $cDao = new CreatorDAOImpl();
        $creator = $cDao->readByName("Gronkh");

        $client = new YouTubeRESTClient();
        $result = $client->getLatestUploads("UUYJ61XIK64sp6ZFFS8sctxw");

        $builder = new YoutubePostBuilder();
        $posts = $builder->buildYoutubePosts($creator, $result);

        */

        require __DIR__ . "/classes/rest/InstagramWebsiteClient.php";
        $cDao = new CreatorDAOImpl();
        $creator = $cDao->readByName("Gronkh");

        $client = new InstagramWebsiteClient();
        $posts = $client->getLatestImages($creator);
    } elseif($_GET['action'] == "getPost" AND $_GET['time']) {

    }
}

