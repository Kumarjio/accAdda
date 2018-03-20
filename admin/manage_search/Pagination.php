<?php
class Pagination{
	var $baseURL		= '';
	var $totalRows  	= '';
	var $perPage	 	= 10;
	var $numLinks		=  3;
	var $currentPage	=  0;
	var $firstLink   	= '&lsaquo; First';
	var $nextLink		= 'Next';
	var $prevLink		= 'Previous';
	var $lastLink		= 'Last &rsaquo;';
	var $fullTagOpen	= '<div class="pagination pull-right">';
	var $fullTagClose	= '</div>';
	var $firstTagOpen	= '<li class="paginate_button">';
	var $firstTagClose	= '</li>';
	var $lastTagOpen	= '<li class="paginate_button">';
	var $lastTagClose	= '</li>';
	var $curTagOpen		= '<li class="paginate_button active"><a href="javascript:;">';
	var $curTagClose	= '</a></li>';
	var $nextTagOpen	= '<li class="paginate_button">';
	var $nextTagClose	= '</li>';
	var $prevTagOpen	= '<li class="paginate_button">';
	var $prevTagClose	= '</li>';
	var $numTagOpen		= '<li class="paginate_button">';
	var $numTagClose	= '</li>';
	var $anchorClass	= 'paginate_button';
	var $showCount      = true;
	var $currentOffset	= 0;
	var $contentDiv     = '';
    var $additionalParam= '';
	var $link_func      = '';
    
	function __construct($params = array()){
		if (count($params) > 0){
			$this->initialize($params);		
		}
		
		if ($this->anchorClass != ''){
			$this->anchorClass = 'class="'.$this->anchorClass.'" ';
		}	
	}
	
	function initialize($params = array()){
		if (count($params) > 0){
			foreach ($params as $key => $val){
				if (isset($this->$key)){
					$this->$key = $val;
				}
			}		
		}
	}
	
	/**
	 * Generate the pagination links
	 */	
	function createLinks(){ 
		// If total number of rows is zero, do not need to continue
		if ($this->totalRows == 0 OR $this->perPage == 0){
		   return '';
		}

		// Calculate the total number of pages
		$numPages = ceil($this->totalRows / $this->perPage);

		// Is there only one page? will not need to continue
		

		// Determine the current page	
		if ( ! is_numeric($this->currentPage)){
			$this->currentPage = 0;
		}
		
		// Links content string variable
		$output = '';
		
		// Showing links notification
		
		
		$this->numLinks = (int)$this->numLinks;
		
		// Is the page number beyond the result range? the last page will show
		if ($this->currentPage > $this->totalRows){
			$this->currentPage = ($numPages - 1) * $this->perPage;
		}
		
		$uriPageNum = $this->currentPage;
		
		$this->currentPage = floor(($this->currentPage/$this->perPage) + 1);

		// Calculate the start and end numbers. 
		$start = (($this->currentPage - $this->numLinks) > 0) ? $this->currentPage - ($this->numLinks - 1) : 1;
		$end   = (($this->currentPage + $this->numLinks) < $numPages) ? $this->currentPage + $this->numLinks : $numPages;

		// Render the "First" link
		if  ($this->currentPage > $this->numLinks){
			$output .= $this->firstTagOpen 
				. $this->getAJAXlink( '' , $this->firstLink)
				. $this->firstTagClose; 
		}

		// Render the "previous" link
		if  ($this->currentPage != 1){
			$i = $uriPageNum - $this->perPage;
			if ($i == 0) $i = '';
			$output .= $this->prevTagOpen 
				. $this->getAJAXlink( $i, $this->prevLink )
				. $this->prevTagClose;
		}else
		{
			$output .= '<li class="paginate_button previous disabled"><a>Previous</a></li>';
		}

		// Write the digit links
		for ($loop = $start -1; $loop <= $end; $loop++){
			$i = ($loop * $this->perPage) - $this->perPage;
					
			if ($i >= 0){
				if ($this->currentPage == $loop){
					$output .= $this->curTagOpen.$loop.$this->curTagClose;
				}else{
					$n = ($i == 0) ? '' : $i;
					$output .= $this->numTagOpen
						. $this->getAJAXlink( $n, $loop )
						. $this->numTagClose;
				}
			}
		}

		// Render the "next" link
		if ($this->currentPage < $numPages){
			$output .= $this->nextTagOpen 
				. $this->getAJAXlink( $this->currentPage * $this->perPage , $this->nextLink )
				. $this->nextTagClose;
		}else
		{
			$output .= '<li class="paginate_button previous disabled"><a>Next</a></li>';
		}
		

		// Render the "Last" link
		if (($this->currentPage + $this->numLinks) < $numPages){
			$i = (($numPages * $this->perPage) - $this->perPage);
			$output .= $this->lastTagOpen . $this->getAJAXlink( $i, $this->lastLink ) . $this->lastTagClose;
		}

		// Remove double slashes
		$output = preg_replace("#([^:])//+#", "\\1/", $output);

		// Add the wrapper HTML if exists
		$output = $this->fullTagOpen.$output.$this->fullTagClose;
		
		return $output;		
	}

	function getAJAXlink( $count, $text) {
        if($this->link_func == '' && $this->contentDiv == '')
            return '<li class="paginate_button"><a href="'.$this->baseURL.'?'.$count.'"'.$this->anchorClass.'>'.$text.'</a></li>';
		
		$pageCount = $count?$count:0;
		if(!empty($this->link_func)){
			$linkClick = 'onclick="'.$this->link_func.'('.$pageCount.')"';
		}else{
			$this->additionalParam = "{'page' : $pageCount}";
			$linkClick = "onclick=\"$.post('". $this->baseURL."', ". $this->additionalParam .", function(data){
					   $('#". $this->contentDiv . "').html(data); }); return false;\"";
		}
		
	    return "<li class='paginate_button'><a href=\"javascript:void(0);\" " . $this->anchorClass . "
				". $linkClick .">". $text .'</a></li>';
	}
}
?>