<?php

// Counter assigns a unique sequential number to each folder it encounters
global $listDirCount;
global $flag;

$listDirCount = 0;
$flag = 0;

// This function will take the path to build a list of folders and files in that folder
// Then display those folders and files according to the way the operating system shows them. 

function listDir($path) {
	global $listDirCount;
	global $flag;
	
	$folders = array();
	$files = array();
	
	// Open the given path
	if ($handle = opendir($path)) {
		// Loop through its contents adding folder paths or files to separate arrays
		// Make sure not to include "." or ".." in the listing.
		
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				if (is_dir($path . "/" . $file)) {	
					$folders[] = $path . "/" . $file;
				}
				else { $files[] = $file; }
			}
		}
		
		// Once we build the folder array, get a new number, create a clickable link for the folder, 
		// and then construct a div tag which will contain the next list of folders/files.
		// The link will trigger our javascript above to toggle the div's display on and off.
		
		for ($i = 0; $i < count($folders); $i++) {
			$listDirCount++;
			
			// Here is the folder name, so you can add icons and such to this line
			if($flag == 0){
				echo "<tr>";
			}

			echo "<td></td>
				<td>
					<a href=\"javascript:void(0)\" onclick=\"showSubs($listDirCount)\">" . basename($folders[$i]) . "</a>
				</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>";			
			
			echo "<tr id=\"folder" . $listDirCount . "\" style=\"margin-left: 15px; margin-right: 10px; display: none;\">";
			
			$flag++;
			listDir($folders[$i]);
			
			

			// echo '<div id="folder' . $listDirCount . '" style="margin-left: 15px; margin-right: 10px; display: none;">';
			// listDir($folders[$i]);
			// echo '</div>';
		}
		
		// Here we just loop and print the file names. Add icons here for files if you like.
		for ($i = 0; $i < count($files); $i++) {
			// echo "<tr>
			// 	<td>{$files[$i]}</td>
			// 	<td></td>
			// 	<td></td>
			// 	<td></td>
			// 	<td></td>
			// </tr>\n";
		}
		
		// Finally close the directory.
		$flag--;
		closedir($handle);
	}
}

// Kick off the listing with default parameters
// If you want specific folder that is under the folder that this dir is in, use paths like "./nameofdir" or simply "nameofdir"
listDir($localhost_path);
?>