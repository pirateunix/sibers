<?php
/**
 * Created by PhpStorm.
 * User: pirate
 * Date: 02.05.16
 * Time: 16:10
 */

namespace AppBundle\Helpers;


class Paginator
{

    private $items;

    private $pages;

    private $repository;

    private $url;

    private $maxItems;

    private $maxPages;

    private $currPage;

    private $sort;

    public function __construct($repository, $url, $sort, $currPage = 1, $maxItems = 5, $maxPages = 7)
    {
        $this->repository = $repository;
        $this->url = $url;
        $this->currPage = $currPage;
        $this->maxItems = $maxItems;
        $this->maxPages = $maxPages;
        $this->sort = $sort;

        $this->paginate();
    }

    private function paginate()
    {
        $users = $this->repository->findAll();
        $itemCount = count($users);
        $query = $this->repository->createQueryBuilder('p')
            ->orderBy("p.$this->sort")
            ->setFirstResult(($this->currPage - 1) * $this->maxItems)
            ->setMaxResults($this->maxItems)
            ->getQuery();
        $this->items = $query->getResult();

        $this->pages = array();
        $page_count = ceil($itemCount / $this->maxItems);

        $lft = (floor($this->currPage - (($this->maxPages - 1) / 2)) > 0) ?
            floor($this->currPage - (($this->maxPages - 1) / 2)) : 1;
        $rgt = (floor($this->currPage + (($this->maxPages - 1) / 2)) < $page_count) ?
            floor($this->currPage + (($this->maxPages - 1) / 2)) : $page_count;
        if ($lft > 1)
            $this->pages[1] = $this->url . "1/" . $this->sort;
        if ($lft > 2)
            $this->pages['leftPoints'] = '...';
        for ($i = $lft; $i <= $rgt; $i++) {
            $this->pages[$i] = $this->url . "$i/" . $this->sort;
        }
        dump($this->pages);
        if ($rgt < $page_count - 1)
            $this->pages['rightPoints'] = '...';
        if ($rgt < $page_count)
            $this->pages[(int)$page_count] = $this->url . "$page_count/" . $this->sort;

    }

    public function getItems()
    {
        return $this->items;
    }

    public function getPages()
    {
        return $this->pages;
    }

}