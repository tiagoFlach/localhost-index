<?php 

$localhost_path = $_SERVER['DOCUMENT_ROOT'];
// echo $localhost_path;

foreach (new DirectoryIterator($localhost_path) as $localhost) {
	// var_dump($localhost);
	$link = '../../' . $localhost->getFileName();
	if (!$localhost->isDot()) {
		?>
		<tr>
			<td><?php echo getIcon($localhost); ?></td> <!-- Icon -->
			<td><a href="<?php echo $link ?>"><?php echo $localhost->getFileName(); ?></a></td> <!-- Dir/File Name -->
			<td><?php echo date('H:i - d/m/Y', $localhost->getCTime()); ?></td> <!-- Creation Date -->
			<td><?php echo date('H:i - d/m/Y', $localhost->getMTime()); ?></td> <!-- Modification Date -->
			<td><?php echo human_filesize($localhost->getSize()); ?></td> <!-- Size -->
		</tr>
		<?php 
	}
}



function human_filesize($bytes, $decimals = 0) {
    $factor = floor((strlen($bytes) - 1) / 3);
    if ($factor > 0) $sz = 'KMGT';
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . @$sz[$factor - 1] . 'B';
}

function getIcon($object) {

	if ($object->isDir()) {
		return '<svg class="bi bi-box-seam" width="1em" height="1em" viewBox="0 0 16 16" fill="blue" xmlns="http://www.w3.org/2000/svg">
		<path fill-rule="evenodd" d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
	  </svg>';
	} else {
		switch ($object->getType()) {
			case 'file':
				return '<svg class="bi bi-file-richtext" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" d="M4 1h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4z"/>
				<path fill-rule="evenodd" d="M4.5 11.5A.5.5 0 0 1 5 11h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm0-2A.5.5 0 0 1 5 9h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm1.639-3.708l1.33.886 1.854-1.855a.25.25 0 0 1 .289-.047l1.888.974V7.5a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V7s1.54-1.274 1.639-1.208zM6.25 5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5z"/>
			  </svg>';
				break;
			
			default:
				# code...
				break;
		}
	}
}







// function createObject($path){
// 	$array = array();
// 	foreach (new DirectoryIterator($path) as $object) {
// 		// var_dump($object);
// 		$array[] = $object;
// 		//print_r($array);
// 		//echo '<br /><br /><br />';
// 	}
// 	var_dump($array);
// 	return $array;
// }



// function listaArquivos($dir,$nivel){
 
//   $d = dir($dir);
//   $nivel = $nivel + 1;
//   while (false !== ($entry = $d->read()))
//   {
//      if (is_dir($dir.$entry."/"))
//      {
//         if (($entry!=".") && ($entry!=".."))
//         {
//           for($i=1;$i<=$nivel;$i++)
//              echo "&nbsp";
//           echo '<img src="open.bmp" border="0">&nbsp<a href="'.$dir.$entry.'/">'.$entry.'<br></a>';
 
//           listaArquivos($dir.$entry."/",$nivel);
//         }
//      }
//      else
//      {
//         for($i=1;$i<=$nivel;$i++)
//           echo "&nbsp";
//           echo '<img src="copy2.bmp" border="0"> '.$entry.'<br>';
//      }
//   }
//   $d->close();
// }
 
// listaArquivos($localhost_path,3)


// function treeMaps($path, $ind=0){
// 	$pathMap = scandir($path);

// 	foreach($pathMap as $file){
// 		$pf = "$path/$file";
// 		if(is_dir($pf)){
// 			if( $file != "." && $file != ".."){
// 				print str_repeat(' ',$ind)."+$pf\n";
// 				treeMaps("$pf", $ind+1);
// 			}
// 		} else {
// 			print str_repeat(' ',$ind).($ind==0?' ':"'- ")."$pf\n";
// 		}
// 	}
// };
// treeMaps($localhost_path);



// $iterator = new RecursiveDirectoryIterator($localhost_path);
// $filter = new RegexIterator($iterator->getChildren(), '/ ');
// $filelist = array();
// foreach($filter as $entry) {
//     $filelist[] = $entry->getFilename();
// }





// print_r( $dirs);

// $localhost = createObject($localhost_path);



// var_dump($localhost);






// $localhost = new DirectoryIterator($localhost_path);
// sort($localhost);

// foreach (new DirectoryIterator($localhost_path) as $localhost) {
// 	var_dump($localhost);
// 	var_dump($localhost->isDir());
// }




// $localhost = createObject($localhost_path);


// $localhost = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($localhost_path));


// $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($localhost_path));







// $filter = '';
	
// $ite = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($localhost_path));
// $rii = new RegexIterator($ite, "/(".$filter.")/i");

// $files = array(); 
// foreach ($rii as $file) {
//     if (!$file->isDir()) {
//         $fileName = $file->getFilename();
//         $location = str_replace($localhost_path, '', $file->getPath());
//         $files[] = array(
//                 "name" => $fileName,
//                 "type" => "file",
//                 "path" => $location,
//             );           
//     }
// }


// var_dump($rii);
// var_dump($files);


// var_dump($localhost);






// foreach (createObject($localhost_path) as $localhost) {
// 	var_dump($localhost);
// }



















// define('SITE_ROOT_URL','/'.$_SERVER['HTTP_HOST'].'');

// $localhost_path = $_SERVER['DOCUMENT_ROOT'];

// // clean and check $root_path
// $localhost_path = rtrim($localhost_path, '\\/');
// $localhost_path = str_replace('\\', '/', $localhost_path);
// if (!@is_dir($localhost_path)) {
//     echo "<h1>Localhost path \"{$root_path}\" not found!</h1>";
//     exit;
// }


// echo gethostname();
// echo "<br />";
// echo SITE_ROOT_URL;


// // Adds pretty filesizes
// function pretty_filesize($file) {
// 	$size=filesize($file);
// 	if($size<1024){$size=$size." Bytes";}
// 	elseif(($size<1048576)&&($size>1023)){$size=round($size/1024, 1)." KB";}
// 	elseif(($size<1073741824)&&($size>1048575)){$size=round($size/1048576, 1)." MB";}
// 	else{$size=round($size/1073741824, 1)." GB";}
// 	return $size;
// }

// // // Checks to see if veiwing hidden files is enabled
// // if($_SERVER['QUERY_STRING']=="hidden"){
// // 	$hide="";
// //  	$ahref="./";
// //  	$atext="Hide";
// // } else {
// // 	$hide=".";
// //  	$ahref="./?hidden";
// //  	$atext="Show";
// // }



// // Opens directory
// $path = opendir($localhost_path);

// // Gets each entry
// while($entryName=readdir($path)) {
//    $dirArray[]=$entryName;
// }

// // Closes directory
// closedir($path);

// // Counts elements in array
// $indexCount=count($dirArray);

// // Sorts files
// sort($dirArray);

// var_dump($dirArray)

?>