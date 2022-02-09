<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('waktu_data')){
    
    function waktu_data($id, $time=30){
        $id2=null;
        for ($i=3; $i < strlen($id); $i++) { 
            $id2 .= $id[$i];
        }
        $waktu = date_create(date('Y-m-d H:i:s',(int)$id2));
        $waktu2 = date_create(date('Y-m-d H:i:s'));
        $diff = date_diff($waktu, $waktu2);
        // $diff->format('%d%i');

        if ((int)$diff->format('%Y')>0) {
            return false;
        }elseif ((int)$diff->format('%m')>0) {
            return false;
        }elseif ((int)$diff->format('%d')>$time) {
            return false;
        }/*elseif ((int)$diff->format('%H')>$time) {
            return false;
        }elseif ((int)$diff->format('%i')>$time) {
            return false;
        }*/else {
            return true;
        }
    }   
}

if ( ! function_exists('konv_waktu')){
    function konv_waktu($id){
        $id2=null;
        for ($i=3; $i < strlen($id); $i++) {
            $id2 .= $id[$i];
        }
        return date('Y-m-d',(int)$id2);
    }
}

if (!function_exists('paginasi_gen')) {
    function paginasi_gen($limit, $num_rows){
        $i=0;
        $pag=1;
        $next_prev = $num_rows/$limit;
        $ret = $next_prev>=6?'<button id="prev" value="prev">&laquo;</button>':null;
        $last_page = $num_rows-($num_rows%$limit)+1;
        $page = 0;//$pag;
        while ($num_rows > 0&&$i<5) {
            $kurang = ($num_rows-$limit)<0?($num_rows-$limit):0;
            $first_page = $i==0?'id="first-pag" class="active limit-number"':null;
            $title = 'title="Tampilkan index ke-'.($page+1).'"';
            if ($i<3) {
                $ret .= '<button '.$title.' '.$first_page.' value="'.$page.'">'.($page+1).'</button>';
            }else if($i==3&&($num_rows-$limit-$kurang)>$limit*2){
                $ret .= '<button id="titik" data-num="0" value="...">...</button>';
            }else if($i==3){
                $ret .= '<button '.$title.' value="'.$page.'">'.($page+1).'</button>';
            }else if ($i==4) {
                
                $ret .= '<button '.$title.' id="last-number" value="'.($last_page-1).'">'.$last_page.'</button>';
            }
            $num_rows -= $limit;
            $page += $limit;
            $i++;
        }
        $ret .= /*$i==1||$num_rows==0*/$next_prev>=6?'<button value="next">&raquo;</button>':null;
        return $ret;
    }
}

