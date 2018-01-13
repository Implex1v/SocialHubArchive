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
    function readLatestPostsOf($creatorId, $count = 12) {
        $data = array(
            ":cid" => $creatorId,
            ":lim" => $count
        );

        $filer = $this->buildFilterString();
        $sql = "SELECT * FROM Post WHERE creatorId = 1 ".$filer." ORDER BY released DESC LIMIT 12;";
        file_put_contents("sql.log", $filer."\n", FILE_APPEND);
        $statement = $this->pdo->prepare($sql);
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

    /**
     * {@inheritdoc}
     */
    function readPosts($creatorId, $time, $count) {
        if(!$creatorId) {
            throw new RuntimeException("creatorId is null");
        }

        if(!$time) {
            throw new RuntimeException("timestamp is null");
        }

        if(!$count) {
            throw new RuntimeException("count is null");
        }

        $filer = $this->buildFilterString();
        $sql = "SELECT * FROM Post WHERE creatorId = 1 AND released < :zeit ".$filer." ORDER BY released DESC LIMIT 12;";
        file_put_contents("sql.log", $filer."\n", FILE_APPEND);
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(":zeit", $time, PDO::PARAM_STR);

        $result = $statement->execute();
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

    /**
     * Creates a where clause for getting posts which filters by the channels the user has disabled in the ui.
     * @return string Returns the where clause if there are filter settings otherwise an empty string
     */
    private function buildFilterString() {
        $filters = $this->filterCookies();

        if(sizeof($filters) == 0) {
            return "";
        }

        $whereClause = "AND (";
        foreach ($filters as $key => $value) {
            $channel = str_replace("filter", "", $key);
            if($value == "0") {
                $whereClause .= "channel != '".$channel. "' && ";
            }
        }

        if($whereClause == "AND (") {
            return "";
        }
        $whereClause = substr($whereClause, 0, -4);
        $whereClause .= ") ";
        return $whereClause;
    }

    /**
     * Returns all cookies which are filter settings
     * @return array The array of filter cookies. Might be empty
     */
    private function filterCookies() {
        global $_COOKIE;
        $filters = array();

        foreach ($_COOKIE as $key => $value) {
            if(substr($key,0, 6) == "filter") {
                $filters[$key] = $value;
            }
        }

        return $filters;
    }
}
