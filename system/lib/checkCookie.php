<?php
    if(!isset($_COOKIE["user-name"]) || !isset($_COOKIE["user-id"])){
        header("Location: ../trang-dang-nhap/");
    }else {
        $username = $_COOKIE["user-name"];
        $uID = $_COOKIE["user-id"];
        $query = "SELECT *
        FROM `user`
        WHERE `username` = '$username'
        AND `ID` = '$uID' LIMIT 1";
        
        $db = new Database();
        if($db->num($query) == 0){
            header("Location: ../trang-dang-nhap/");
        }else {
            $sql = $db->send($query);
            $row = $sql->fetch_assoc();
            setcookie("user-name", $row["username"], time() + (86400), "/");
            setcookie("user-id", $row["ID"], time() + (86400), "/");
        }
    }
?>