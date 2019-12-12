<?php
         
        $stmt_sch = array();
        $search = preg_replace( '/\A[\p{C}\p{Z}]++|[\p{C}\p{Z}]++\z/u', '', htmlspecialchars($_POST['title_sch']));
        $sql_sch = "select * from title where title like '%$search%'";
        foreach($mysqli->query($sql_sch) as $a2) {
            if($v2!=$n-$c1+1){
            	array_push($stmt_sch,$a2);
            	$v2++;
            }
         }
        $title_id=htmlspecialchars($stmt_sch[$v2-1]['id']);

?>