<?php
Class AodLinkPager extends CLinkPager
{
    public $paginationBaseUrl = '';
    public $pageVar = 'page';
    public $paginationParams = ''; // params string in a format key=value&key=value...
    
	/**
	 * Creates the URL suitable for pagination.
	 * This method is mainly called by pagers when creating URLs used to
	 * perform pagination. The default implementation is to call
	 * the controller's createUrl method with the page information.
	 * You may override this method if your URL scheme is not the same as
	 * the one supported by the controller's createUrl method.
	 * @param integer $page the page that the URL should point to. This is a zero-based index.
	 * @return string the created URL
	 */     
	public function createPageUrl($page)
	{		
		// if not set $paginationBaseUrl then load request->baseUrl
        if( empty($this->paginationBaseUrl) ) $this->paginationBaseUrl = Yii::app()->request->getBaseUrl();
        $link = $this->paginationBaseUrl;
        //
        if($page>0){ // page 0 is the default
            $page++;
            $link .= "/{$this->pageVar}/$page";
            if( !empty( $this->paginationParams ) ) $link .= '?' . $this->paginationParams;
        } else $link .= "";
        //
        return $link;
	}
    
/*    /**
     * Creates a page button.
     * You may override this method to customize the page buttons.
     * @param string the text label for the button
     * @param integer the page number
     * @param string the CSS class for the page button. This could be 'page', 'first', 'last', 'next' or 'previous'.
     * @param boolean whether this page button is visible
     * @param boolean whether this page button is selected
     * @return string the generated button
     */
    /*protected function createPageButton($label,$page,$class,$hidden,$selected)
    {
            if($hidden || $selected)
                    $class.=' '.($hidden ? self::CSS_HIDDEN_PAGE : self::CSS_SELECTED_PAGE);
            //return '<li class="'.$class.'">'.CHtml::ajaxLink($label,$this->createPageUrl($page)).'</li>';
            return '<li class="'.$class.'">'.CHtml::ajaxLink($label,$this->createPageUrl($page)).'</li>';
    }

    /*
    protected function createPageButtons()
        {
                if(($pageCount=$this->getPageCount())<=1)
                        return array();

                list($beginPage,$endPage)=$this->getPageRange();
                $currentPage=$this->getCurrentPage(false); // currentPage is calculated in getPageRange()
                
                $buttons=array();

                // first page
                $buttons[]=$this->createPageButton($this->firstPageLabel,0,$this->firstPageCssClass,$currentPage<=0,false);

                // prev page
                if(($page=$currentPage-1)<0)
                        $page=0;
                //Riyaz: if we are in 1st page, lets not show the previous link
                if($currentPage>0)
                $buttons[]=$this->createPageButton($this->prevPageLabel,$page,$this->previousPageCssClass,$currentPage<=0,false);

                // internal pages
                for($i=$beginPage;$i<=$endPage;++$i)
                        $buttons[]=$this->createPageButton($i+1,$i,$this->internalPageCssClass,false,$i==$currentPage);

                // next page
                if(($page=$currentPage+1)>=$pageCount-1)
                        $page=$pageCount-1;
                
                //Riyaz: if we are already in last page, lets not show the next link
                if($currentPage+1 < $pageCount)
                $buttons[]=$this->createPageButton($this->nextPageLabel,$page,$this->nextPageCssClass,$currentPage>=$pageCount-1,false);

                // last page
                $buttons[]=$this->createPageButton($this->lastPageLabel,$pageCount-1,$this->lastPageCssClass,$currentPage>=$pageCount-1,false);

                return $buttons;
        }/**/


}
