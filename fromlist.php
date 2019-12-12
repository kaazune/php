<?php
$sql_list="select * from title";
		$stmt_list = array();
		foreach($mysqli->query($sql_list) as $a1) {
			if($v1!=$n+1){
        		array_push($stmt_list,$a1);
        		$v1++;
        	}
        }
        $title_id=htmlspecialchars($stmt_list[intval($v1-1)]['id']);
        
      ?>