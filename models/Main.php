<?php

class Main 
{
    const SHOW_BY_DEFAULT = 5;//count of items in page

    public static function getNewsList($count = self::SHOW_BY_DEFAULT)
    {
        $newsList = array();
        $i = 0;
        $connection = Db::getConnection();
        $stmt = $connection->query("SELECT * FROM contacts ORDER BY created_at DESC LIMIT $count");
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['first_name'] = $row['first_name'];
            $newsList[$i]['last_name'] = $row['last_name'];
            $newsList[$i]['phone'] = $row['phone'];
            $newsList[$i]['email'] = $row['email'];
            $newsList[$i]['address'] = $row['address'];
            $i++;
        }
        return $newsList;
    }

    public static function getTotalNewsById()
    {
        $connection = Db::getConnection();
        $sql = "SELECT count(*) FROM `contacts`";
        $result = $connection->prepare($sql);
        $result->execute();
        $number_of_rows = $result->fetchColumn();
        return $number_of_rows;
    }

    public static function getNewsListByPage($page = 1)
    {
        $limit = Main::SHOW_BY_DEFAULT;
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        $newsList = array();
        $i = 0;
        $connection = Db::getConnection();
        $stmt = $connection->query("SELECT * FROM contacts ORDER BY created_at DESC LIMIT $limit OFFSET $offset");
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['first_name'] = $row['first_name'];
            $newsList[$i]['last_name'] = $row['last_name'];
            $newsList[$i]['phone'] = $row['phone'];
            $newsList[$i]['email'] = $row['email'];
            $newsList[$i]['address'] = $row['address'];
            $i++;
        }
        return $newsList;
    }
}