<?php
$range = 3;

// if not on page 1, don't show back links
if ($currentPage > 1) {
   // show << link to go back to page 1
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
   // get previous page num
   $prevPage = $currentPage - 1;
   // show < link to go back to 1 page
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> ";
} // end if 

// loop to show links to range of pages around current page
for ($x = ($currentPage - $range); $x < (($currentPage + $range) + 1); $x++) {
   // if it's a valid page number...
   if (($x > 0) && ($x <= $pageCount)) {
      // if we're on current page...
      if ($x == $currentPage) {
         // 'highlight' it but don't make a link
         echo " [<b>$x</b>] ";
      // if not current page...
      } else {
         // make it a link
         echo " <a href='{$_SERVER['PHP_SELF']}?currentPage=$x'>$x</a> ";
      } // end else
   } // end if 
} // end for

// if not on last page, show forward and last page links        
if ($currentPage != $pageCount) {
   // get next page
   $nextPage = $currentPage + 1;
    // echo forward link for next page 
   echo " <a href='{$_SERVER['PHP_SELF']}?currentPage=$nextpage'>></a> ";
   // echo forward link for lastpage
   echo " <a href='{$_SERVER['PHP_SELF']}?currentPage=$totalpages'>>></a> ";
} // end if
/****** end build pagination links ******/
?>