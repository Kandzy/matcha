<?php


$db = new \App\Database\DatabaseRequest($container->db);

if($db->createDataBase("db_matcha")) {
    $db->UseDB("db_matcha");

    /**
     * User Table creation
     */

    $db->createTable("Users", "UserID");
    $db->addTableColumn("Users", "Login", "varchar(100) NOT NULL UNIQUE");
    $db->addTableColumn("Users", "Password", "varchar(100)");
    $db->addTableColumn("Users", "Email", "varchar(100) NOT NULL UNIQUE");
    $db->addTableColumn("Users", "FirstName", "varchar(100)");
    $db->addTableColumn("Users", "LastName", "varchar(100)");
    $db->addTableColumn("Users", "City", "varchar(100)");
    $db->addTableColumn("Users", "Country", "varchar(100)");
    $db->addTableColumn("Users", "Age", "varchar(100)");
    $db->addTableColumn("Users", "Gender", "varchar(100)");
    $db->addTableColumn("Users", "map_height", "FLOAT(10)");
    $db->addTableColumn("Users", "map_width", "FLOAT(10)");
    $db->addTableColumn("Users", "Bio", "varchar(5000)");
    $db->addTableColumn("Users", "Tags", "varchar(2000)");
    $db->addTableColumn("Users", "Notification", "varchar(1) DEFAULT '1'");
    $db->addTableColumn("Users", "FullRegister", "varchar(1) DEFAULT '0'");

    /**
     * Photo Table creation
     */

    $db->createTable("Pictures", "PicID");
    $db->addTableColumn("Pictures", "UserID", "INT(11)");
    $db->addTableColumn("Pictures", "url", "varchar(1000)");
    $db->addTableColumn("Pictures", "Likes", "INT(10)");
    $db->addTableColumn("Pictures", "data", "DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP");

    /**
     * Temp users
     */

    $db->createTable("confirmation", "UID");
    $db->addTableColumn("confirmation", "Login", "varchar(100) NOT NULL UNIQUE");
    $db->addTableColumn("confirmation", "Passwd", "varchar(100)");
    $db->addTableColumn("confirmation", "Email", "varchar(100) NOT NULL UNIQUE");
    $db->addTableColumn("confirmation", "hash", "varchar(256)");
    /**
     * Likes Table creation
     */

    $db->createTable("Likes", "LikeID");
    $db->addTableColumn("Likes","UserID", "varchar(10)");
    $db->addTableColumn("Likes","Target", "varchar(256)");
    $db->addTableColumn("Likes","Type", "varchar(256)");

    /**
     * Comments Table Creation
     */

    $db->createTable("Comments", "ComID");
    $db->addTableColumn("Comments", "UserID", "INT(11)");
    $db->addTableColumn("Comments", "UserName", "varchar(100)");
    $db->addTableColumn("Comments", "PicID", "INT(11)");
    $db->addTableColumn("Comments", "text", "varchar(1000)");
    $db->addTableColumn("Comments", "data", "DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP");

    /**
     * Topics table creation
     */

    $db->createTable("Topics", "TopicID");
    $db->addTableColumn("Topics", "Owner", "varchar(100)");
    $db->addTableColumn("Topics", "UserID", "INT(11)");
    $db->addTableColumn("Topics", "Title", "varchar(100)");
    $db->addTableColumn("Topics", "Description", "varchar(1000)");
    $db->addTableColumn("Topics", "TopicCreationDate", "DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP");

    /**
     * Topics Messegess
     */

    $db->createTable("TopicComments", "TCommentID");
    $db->addTableColumn("TopicComments", "UserID", "INT(11)");
    $db->addTableColumn("TopicComments", "TopicID", "INT(11)");
    $db->addTableColumn("TopicComments", "Comment", "varchar(10000)");
    $db->addTableColumn("TopicComments", "CreationDate", "DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP");
}