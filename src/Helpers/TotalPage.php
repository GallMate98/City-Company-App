<?php

namespace App\Helpers;

class TotalPage {
    public function allPage(int $pageSize, int $count) {

        $totalPage = $count/$pageSize;

        if(!(is_int($totalPage))) {
            $totalPage= (int)(($totalPage)+1);
        }

        return $totalPage;
    }
}
