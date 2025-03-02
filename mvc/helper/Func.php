<?php 
class Func{
    function pagination($total_page,$page){
        if ($total_page > 5) 
        {
            if ($page < 6) 
            {
                for ($i=1; $i <= 6 ; $i++) { 
                    $page_array[] = $i;
                }
                $page_array[] = "...";
                $page_array[] = $total_page;
            }
            else 
            {
                $end_limit = $total_page -5;
                if ($page > $end_limit) {
                    $page_array[] = 1;
                    $page_array[] = "...";
                    for ($i=$end_limit; $i < $total_page; $i++) { 
                        $page_array[] = $i;
                    }
                }
                else 
                {
                    $page_array[] = 1;
                    $page_array[] = "...";
                    for ($i=$page-1; $i <= $page+1 ; $i++) { 
                        $page_array[] = $i;
                    }
                    $page_array[] = "...";
                    $page_array[] = $total_page;
                }
            }
        }
        else 
        {
            for ($i=1; $i <= $total_page; $i++) 
            { 
                $page_array[] = $i;
            }
        }
        $page_link = "";
        $prev_link = "";
        $next_link = "";
        for ($i=0; $i < count($page_array); $i++) { 
            if ($page == $page_array[$i]) {
                $page_link .= '<li> 
                    <a href="javascript:void(0)" class="page-link active disabled btn text-dark" num-page="'.$page_array[$i].'">'.$page_array[$i].'</a>
                </li>';
                $prev_id = $page_array[$i] - 1;
                if ($prev_id <=0) {
                    $prev_link .= '<li> 
                        <a href="javascript:void(0)" class="page-link disabled btn text-dark">❮</a>
                    </li>';
                }
                else
                {    
                    $prev_link .= '<li> 
                        <a href="javascript:void(0)" class="page-link btn text-dark" num-page="'.$prev_id.'">❮</a>
                    </li>';
                }
                $next_id = $page_array[$i] + 1;
                if ($next_id > $total_page) {
                    $next_link .= '<li> 
                        <a href="javascript:void(0)" class="page-link disabled btn text-dark">❯</a>
                    </li>';
                }
                else
                {
                    $next_link .= '<li> 
                        <a href="javascript:void(0)" class="page-link btn text-dark" num-page="'.$next_id.'">❯</a>
                    </li>';
                }
            }
            else 
            {
                if ($page_array[$i]=="...") {
                    $page_link .= '<li> 
                        <a href="javascript:void(0)" class="page-link disabled btn text-dark">...</a>
                    </li>';
                }
                else
                {
                    $page_link .= '<li> 
                        <a href="javascript:void(0)" class="page-link btn text-dark" num-page="'.$page_array[$i].'">'.$page_array[$i].'</a>
                    </li>';
                }
            }
        }
        return $prev_link.$page_link.$next_link;
    }
}
?>