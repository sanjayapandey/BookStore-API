<?php
include("config.php");
						//query to get all books
						if (isset($_POST['searchTitle']) && $_POST['searchTitle']!= '') {
							$searchTitle = $_POST['searchTitle'];
							$token = strtok($searchTitle, " ");
							while ($token !== false)
								{
									$sql[] = 'UPPER(title) like UPPER("%'.$token.'%")';
									$token = strtok(" ");
								} 
							$query = 'SELECT ISBN, title FROM books where '.implode(" OR ", $sql).' ORDER BY title';
						}else{
							$query = 'SELECT ISBN, title FROM books ORDER BY title';
						}
						$result = mysql_query($query);
						//iterate over all the rows
						$orderedRow = array();
						while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
							if (isset($_POST['searchTitle']) && $_POST['searchTitle']!= '') {
								$searchTitle = $_POST['searchTitle'];
								
								$string1 = str_replace(array('.', ','), '' , $row['title']);
								$string2 = str_replace(array('.', ','), '' , $searchTitle);
							
								$array1 = explode(" ",$string1);
								$array2 = explode(" ",$string2);
								//calculate LCS length
								$LCSLength = LCSLength($array1,$array2);
								$orderedRow[] = array("LCSLength"=>$LCSLength,"data"=>$row);
							}else {
								$orderedRow[] = array("LCSLength"=>0,"data"=>$row);
							}
						}
						usort($orderedRow, function($a, $b) {
							return $b['LCSLength']-$a['LCSLength'];
						});
						$result = array();
						foreach ($orderedRow as $row => $value){
							array_push($result,array('ISBN'=>$value["data"]["ISBN"], 'title'=>$value["data"]["title"]));
							
						}
echo json_encode(array("result"=>$result));
													
		 /*
		  * Algorithm to find Longest Common Subsequence
		  * 
		  * function LCSLength(X[1..m], Y[1..n])
		    C = array(0..m, 0..n)
		    for i := 0..m
		       C[i,0] = 0
		    for j := 0..n
		       C[0,j] = 0
		    for i := 1..m
		        for j := 1..n
		            if X[i] = Y[j]
		                C[i,j] := C[i-1,j-1] + 1
		            else
		                C[i,j] := max(C[i,j-1], C[i-1,j])
		    return C[m,n]
		  */
		 function LCSLength ($array1, $array2){
		 	$temp = array();
		 	for ($i=0;$i<=sizeof($array1);$i++){
		 		$temp[$i][0]=0;
		 	}
		 	for($j=0;$j<=sizeof($array2);$j++){
		 		$temp[0][$j]=0;
		 	}
		 	for ($i=0;$i<sizeof($array1);$i++){
				$posX=$i+1;
				for ($j=0;$j<sizeof($array2);$j++){
					$posY=$j+1;
					if (strcasecmp($array1[$i], $array2[$j]) == 0) {
						$temp[$posX][$posY] = $temp[$posX-1][$posY-1]+1;
					}else {
						$temp[$posX][$posY] = max($temp[$posX][$posY-1], $temp[$posX-1][$posY]);
					}
				}
			}
			return $temp[sizeof($array1)][sizeof($array2)];
		 }
		 
?>
