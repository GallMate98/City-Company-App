<?php

namespace App\Helpers;

class PaginationHelper {
    public function getPageCount(int $pageSize, int $count) {
        $totalPage = $count/$pageSize;

        if(!(is_int($totalPage))) {
            $totalPage= (int)(($totalPage)+1);
        }

        return $totalPage;
    }

    public function paginationForTop(array $topPerPage, int $currentPage, int $pageSize) {
        $min = ($currentPage-1)*$pageSize+1;
        $max = $currentPage*$pageSize;
        
        $goodItems=0;

        foreach($topPerPage as $top) {

            $goodItems++;
            if($goodItems>=$min && $goodItems<=$max) {
                $myPageItems[] = $top;
            }
        }

        return $myPageItems;
    }
}
