<?php


require __DIR__.'/../db/DBConnection.php';
require __DIR__.'/../db/SQLTableHandler.php';
require __DIR__."/../entity/Post.php";
require __DIR__."/../entity/Api.php";
require __DIR__."/../entity/Creator.php";
require __DIR__."/../dao/custom/interface/ApiCustomDAO.php";
require __DIR__."/../dao/generated/interface/ApiDAO.php";
require __DIR__."/../dao/generated/ApiBuilder.php";
require __DIR__."/../dao/custom/ApiCustomDAOImpl.php";
require __DIR__."/../dao/generated/ApiDAOImpl.php";
require __DIR__."/../dao/custom/interface/PostCustomDAO.php";
require __DIR__."/../dao/generated/interface/PostDAO.php";
require __DIR__."/../dao/generated/PostBuilder.php";
require __DIR__."/../dao/custom/PostCustomDAOImpl.php";
require __DIR__."/../dao/generated/PostDAOImpl.php";
require __DIR__."/../dao/custom/interface/CreatorCustomDAO.php";
require __DIR__."/../dao/generated/interface/CreatorDAO.php";
require __DIR__."/../dao/generated/CreatorBuilder.php";
require __DIR__."/../dao/custom/CreatorCustomDAOImpl.php";
require __DIR__."/../dao/generated/CreatorDAOImpl.php";
