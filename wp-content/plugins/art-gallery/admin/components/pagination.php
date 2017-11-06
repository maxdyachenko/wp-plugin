<?php

class Pagination{

    public $total;
    public $limit;
    public $amount;
    public $currentPage;
    public $gallery;
    public $pageUrl;


    public function __construct($total, $currentPage, $limit, $galleryName, $page){
        $this->total = $total ? $total : 1;//to avoid break down of module if no content

        $this->limit = $limit;

        $this->gallery = $galleryName;

        $this->amount = $this->getAmountOfPages();

        $this->setCurrentPage($currentPage);

        $this->pageUrl = $page;
    }

    public function get(){
        $html = '<nav aria-label="Images pages" class="pagination-container"><ul class="pagination justify-content-end">';
        $html .= $this->getPreviousButton();

        $html .= $this->getPages();

        $html .= $this->getNextButton();
        $html .= '</ul></nav>';
        echo $html;
    }

    public function getPages(){
        $html = '';
        for ($i = 0;$i < $this->amount; $i++){
            $page = $i + 1;
            $active = $this->currentPage == $i + 1 ? 'active' : false;
            $link = $this->generateLink($i + 1);
            $html .= '<li class="page-item '.$active.'"><a class="page-link" href="'.$link.'">'. $page .'</a></li>';
        }
        return $html;
    }

    public function generateLink($index){
        return GALLERY_PAGE_TEMPLATE_URL . $this->gallery. '&' . $this->pageUrl . $index;
    }

    public function setCurrentPage($currentPage) {
        if ($currentPage > 0 && $currentPage <= $this->amount) {
            $this->currentPage = $currentPage;
        } else{
            $this->currentPage = 1;
        }
    }

    public function getAmountOfPages() {
        return ceil($this->total / $this->limit);
    }


    public function getPreviousButton(){
        $className = $this->currentPage == 1 ? 'disabled' : false;


        $link = $this->generateLink($this->currentPage - 1);

        return '<li class="page-item ' .$className.'"><a class="page-link" href="'. $link .'" tabindex="-1">Previous</a></li>';
    }

    public function getNextButton(){
        $className = $this->currentPage == $this->amount ? 'disabled' : false;

        $link = $this->generateLink($this->currentPage + 1);

        return '<li class="page-item ' .$className.'"><a class="page-link" href="'. $link .'">Next</a></li>';
    }

}

