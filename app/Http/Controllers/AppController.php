<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function home(){

        $localhost_path = $_SERVER['DOCUMENT_ROOT'];
        // $dir_tree = $this->dirtree($localhost_path);

    	return view('pages.home', [
            // 'dir_tree' => $dir_tree,
            'localhost_path' => $localhost_path,
            'page_active' => 'home'
        ]);
    }

    public function listDir(){

        if(isset($_POST['directory'])){
            $directory = $_POST['directory'];
        } else {
            $directory = $_SERVER['DOCUMENT_ROOT'];
        }

        $array = array();

        foreach (new \DirectoryIterator($directory) as $path) {
            if (! $path->isDot()){
                $array[$path->getPathname()]['ATime'] = $path->getATime();
                $array[$path->getPathname()]['CTime'] = $path->getCTime();
                $array[$path->getPathname()]['MTime'] = $path->getMTime();
                $array[$path->getPathname()]['Basename'] = $path->getBasename();
                $array[$path->getPathname()]['Extension'] = $path->getExtension();
                $array[$path->getPathname()]['Filename'] = $path->getFilename();
                $array[$path->getPathname()]['Path'] = $path->getPath();
                $array[$path->getPathname()]['Pathname'] = $path->getPathname();
                $array[$path->getPathname()]['Size'] = $path->getSize();
                $array[$path->getPathname()]['Type'] = $path->getType();
                $array[$path->getPathname()]['isDir'] = $path->isDir();
            }
        }
        
        return response()->json($array);
    }
}
