<?php 




//var_dump($localhost_path);
$count = 1;

//var_dump($dir_tree);


function listFiles($key, $value){
	global $count;

	if(is_array($value)){
		echo '
		<tr>
			<td>
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#folder-num-'. $count .'" aria-expanded="true" aria-controls="collapseTwo">
					<i class="fas fa-fw fa-folder"></i>
					<span>'. $key .'</span>
				</a>
			</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
			
		<tr class="collapse" id="folder-num-'. $count .'" aria-labelledby="headingTwo" data-parent="#accordionSidebar">';
		$count++;

		foreach($value as $chave => $valor){
			listFiles($chave, $valor);
		}
		
		echo '</tr>';
		
	} else {
		echo '
		<tr>
			<td> FILE  ->  ' . $value . '</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>';
	}
};


	

foreach ($dir_tree as $key => $value) {
	listFiles($key, $value);
break;	
}

?>