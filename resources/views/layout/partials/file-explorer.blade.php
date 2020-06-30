<?php 




//var_dump($localhost_path);


function listFolder($path, $localhost_path){
	foreach ($path as $key => $value) {
		if(is_array($value)){
			echo "<tr>
				<td><a href='" . $localhost_path . "/" . $key . "'>" . $key . "</a></td>
			</tr>";
		} else {
			echo "<tr>
				<td> FILE  ->  " . $value . "</td>
			</tr>";
		}

		
	}
}

listFolder($dir_tree, $localhost_path);

?>