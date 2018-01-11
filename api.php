<?php

require __DIR__ . "/classes/util/autoload.php";

if($_GET['action']) {
    if($_GET['action'] = "fetch") {
        require __DIR__ . "/classes/rest/TwitterRESTClient.php";
        require __DIR__ . "/classes/builder/TwitterPostBuilder.php";

        $cDao = new CreatorDAOImpl();
        $creator = $cDao->readByName("Gronkh");

        $client = new TwitterRESTClient();
        $result = $client->readFeed($creator->getTwitterId(), 10);

        $builder = new TwitterPostBuilder();
        $cc = $builder->buildTwitterPosts($creator, $result);
    }
}

