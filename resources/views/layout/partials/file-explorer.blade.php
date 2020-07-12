<?php

function humanFilesize($bytes, $decimals = 1) {

    $units = array("TB","GB","MB","kB","B");
    $total = count($units);
    
    while ($total-- && $bytes > 1024) {
        $bytes /= 1024;
    }
    
    return str_replace('.', ',', round($bytes, $decimals))." ".$units[$total];
}

function icons($type, $extension){
    if($type == "dir"){
        return "folder fas";
    } elseif($type == "file") {
        switch ($extension) {
            case 'php':
                return "code fas";
                break;
            case '7z': 
            case 'zip':
            case 'xz':
                return "file-archive fas";
                break;
            case 'pdf':
                return "file-pdf fas";
                break;
            case 'sql':
                return "database fas";
                break;
            case 'csv':
                return "file-csv fas";
                break;
            case 'html':
                return "html5 fab";
                break;
            case 'css':
                return "css3-alt fab";
                break;
            case 'js':
            case 'json':
                return "js fab";
                break;
            case 'mp3':
                return "file-audio fas";
                break;
            case 'jpg':
            case 'png':
                return "file-image fas";
                break;
            case 'txt':
                return "file-alt fas";
                break;
            case 'md':
                return "markdown fas";
                break;
            case 'sh':
                return "file-code fas";
                break;
            default:
                return "file fas";
                break;
        }
    }  
}


$directory = new DirectoryIterator($localhost_path);

foreach($directory as $key => $value){
	
	if (!$value->isDot()){
        
		echo "<tr>
			<td><i onclick=\"listDir('". $value->getPathname() ."', '". $value->getFilename() ."')\" class=\"fas fa-angle-right\"></i></td>
            <td>
                <i class=\"fa-primary fa-fw fa-". icons($value->getType(), $value->getExtension()) ."\"></i>
                <a href=\"../../". $value->getFilename() ."\" >" . $value->getFilename() . "</a>";

        if($value->isDir()){
            exec('cd ../../'. $value->getFilename() .' && git config remote.origin.url', $link_github);
            $link_github = implode("", $link_github);
            
            if($link_github){
                echo "<a class=\"github\" href=\"". $link_github ."\">
                        <i class=\"fab fa-lg fa-github\" ></i>
                    </a>";
            }
        }
        
        echo "</td>
            <td>
				". humanFilesize($value->getSize()) ."
			</td>
			<td class=\"text-right\">
				". date('d / m / Y', $value->getCTime()) ."
			</td>
			<td class=\"text-right\">
				". date('d / m / Y', $value->getMTime()) ."
            </td>
            <td></td>";

            if($value->isDir()){
                echo "<div id=\"". $value->getFilename() ."\"></div>";
            }

        echo "</tr>";
        
        
    }
    
}

?>