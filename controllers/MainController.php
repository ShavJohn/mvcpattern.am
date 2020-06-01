<?php

class MainController
{
    public function actionIndex($page = 1) //pageination page-1
    {

        $newsList = array();
        $newsList = Main::getNewsList();
        $total = Main::getTotalNewsById();
        $newsList = Main::getNewsListByPage($page);
        $pagination = new Pagination($total, $page, Main::SHOW_BY_DEFAULT, 'page-');

        require ROOT . "/views/main/main.php";

        return true;
    }
}