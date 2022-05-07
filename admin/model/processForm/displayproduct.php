<?php
    include '../header/header.php';
    $db = new DataBase();
    $page = 1;
    $paging = 0;
    $limit = 7;
    $cate = 'all';
    if(isset($_GET['page'])) $page = $_GET['page'];
    if(isset($_GET['cate'])) $cate = $_GET['cate'];
    if(isset($_GET['limit'])) $limit = $_GET['limit'];
    $data =array();
    $paging = ($page-1) * $limit;
    $limitpage = $paging + $limit;
    $query = "";
    if($cate != "all"){
        $query = "SELECT *
        FROM product
        WHERE cate ='$cate'
        ORDER BY ID DESC
        LIMIT $paging,$limitpage";
    }
    else{
        $query = "SELECT *
            FROM product 
            ORDER BY ID DESC              
            LIMIT $paging,$limit";
    }
    $sql = $db->send($query);
    
    while($rows = $sql->fetch_array()){
        array_push($data, array('id' => $rows['ID'],
            'name' => $rows['name'],
            'cate' => $rows['cate'],
            'price' => $rows['price'],
            'amount' => $rows['amount'],
            'detail' => $rows['detail']
        ));
    }
    $returndata = array('data'=>$data, 'page'=>$page, 'cate'=>$cate, 'limit'=>$limit);
    echo json_encode($returndata);
?>