<?php

namespace app\core;
use mysqli;

class Paginator
{
    public int $elementsPerPage = 10;
    protected int $currentPage;
    protected int $start;
    protected string $uri = '';
    protected int $aroundPages = 3;
    protected object $db;


    public function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->currentPage = $_GET['page'] ?? 1;
        if($this->currentPage <1){
            $this->currentPage = 1;
        }
        if($this->currentPage > $this->pagesCount()){
            $this->currentPage = $this->pagesCount();
        }

    }

    /**
     * get start ads id
     * @return int
     */
    public function fromId():int
    {
        return $this->start = ($this->currentPage - 1) * $this->elementsPerPage;
    }

    /**
     * get count of ads
     * @return int
     */
    public function adsCount():int
    {
        $sql = "select count(*) from ads;";
        $res = $this->db->query($sql);
        return $res->fetch_column();

    }

    /**
     * get count of pages
     * @return int
     */
    public function pagesCount():int
    {
        return ceil($this->adsCount()/$this->elementsPerPage);
    }

    /**
     * create link for selected page
     * @param $page
     * @return string
     */
    public function createLink($page):string
    {
        return "{$this->uri}?page={$page}";
    }

    /**
     * create buttons for pages
     * @return string
     */
    public function createPagesButtons():string
    {
        $back = '';
        $forward = '';
        $startPage = '';
        $endPage = '';
        $leftPages = '';
        $rightPages = '';

        if ($this->currentPage > 1){
            $back .= "<li class='page_item'><a class='page_link' href='". $this->createLink($this->currentPage - 1) . "'>&lt;</a></li>";
        }

        if ($this->currentPage < $this->pagesCount()){
            $forward .= "<li class='page_item'><a class='page_link' href='". $this->createLink($this->currentPage + 1) . "'>&gt;</a></li>";
        }

        if ($this->currentPage > $this->aroundPages){
            $startPage .= "<li class='page_item'><a class='page_link' href='". $this->createLink(1) . "'>&laquo;</a></li>";
        }

        if ($this->currentPage < ($this->pagesCount() - $this->aroundPages)){
            $endPage .= "<li class='page_item'><a class='page_link' href='". $this->createLink($this->pagesCount()) . "'>&raquo;</a></li>";
        }

        for ($i = $this->aroundPages; $i > 0; $i--){
            if ($this->currentPage - $i > 0){
                $leftPages .= "<li class='page_item'><a class='page_link' href='". $this->createLink($this->currentPage - $i) . "'>". $this->currentPage - $i . "</a></li>";
            }
        }

        for ($i = 1; $i <= $this->aroundPages; $i++){
            if ($this->currentPage + $i <= $this->pagesCount()){
                $rightPages .= "<li class='page_item'><a class='page_link' href='". $this->createLink($this->currentPage + $i) . "'>". $this->currentPage + $i . "</a></li>";
            }
        }
        return '<nav class="pages"><ul>' . $startPage . $back . $leftPages . '<li><a>' . $this->currentPage . '</a></li>' . $rightPages . $forward . $endPage . '</ul></nav>';
    }

}