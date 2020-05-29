<?php 

$localhost_path = $_SERVER['DOCUMENT_ROOT'];
// echo $localhost_path;

foreach (new DirectoryIterator($localhost_path) as $localhost) {
	?>
	<tr>
		<td></td> <!-- Icon -->
		<td><?php echo $localhost->getFileName(); ?></td> <!-- Dir/File Name -->
		<td><?php echo date('H:i - d/m/Y', $localhost->getCTime()); ?></td> <!-- Creation Date -->
		<td><?php echo date('H:i - d/m/Y', $localhost->getMTime()); ?></td> <!-- Modification Date -->
		<td><?php echo human_filesize($localhost->getSize()); ?></td> <!-- Size -->
	</tr>
	<?php 
}




function human_filesize($bytes, $decimals = 0) {
    $factor = floor((strlen($bytes) - 1) / 3);
    if ($factor > 0) $sz = 'KMGT';
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . @$sz[$factor - 1] . 'B';
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