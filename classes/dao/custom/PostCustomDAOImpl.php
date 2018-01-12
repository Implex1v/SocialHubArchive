<?php

abstract class PostCustomDAOImpl extends PostBuilder implements PostCustomDAO {
	 /* implement your custom methods here. Use $this->pdo for database connection               
	  * and $this->buildPost($row) for building the object from a db query 
	  * Because tables may have prefixes, this is the full table name: Post*/
    /**
     * {@inheritdoc}
     */
    function postExits($creatorId, $originalId, $channel) {
        $data = array(
            ":cid" => $creatorId,
            ":oid" => $originalId,
            ":channel" => $channel
        );

        $statement = $this->pdo->prepare("SELECT count(*) AS c FROM Post WHERE creatorId = :cid AND originalId = :oid AND channel = :channel;");
        $result = $statement->execute($data);
        if($result AND $row = $statement->fetch()) {
            return $row['c'] > 0;
        } else {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    function readLatestPostsOf($creatorId, $count = 10) {
        $data = array(
            ":cid" => $creatorId,
            ":lim" => $count
        );

        $statement = $this->pdo->prepare("SELECT * FROM Post WHERE creatorId = 1 ORDER BY released DESC LIMIT 47");
        $result = $statement->execute($data);
        if($result) {
            $list = array();

            while($row = $statement->fetch()) {
                $list[] = $this->buildPost($row);
            }

            return $list;
        } else {
            return array();
        }
    }
}
