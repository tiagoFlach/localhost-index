<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function dashboard(){

        $localhost_path = $_SERVER['DOCUMENT_ROOT'];

        $dir_tree = $this->dirtree($localhost_path);

    	return view('pages.dashboard', [
            'dir_tree' => $dir_tree,
            'localhost_path' => $localhost_path
        ]);
    }

    // public function infophp(){
    //     echo 'oi';
    // 	return view('pages.phpinfo');
    // }
    




    // function listDir($path) {
    //     global $listDirCount;
        
    //     $folders = array();
    //     $files = array();
        
    //     // Open the given path
    //     if ($handle = opendir($path)) {
    //         // Loop through its contents adding folder paths or files to separate arrays
    //         // Make sure not to include "." or ".." in the listing.
            
    //         while (false !== ($file = readdir($handle))) {
    //             if ($file != "." && $file != "..") {
    //                 if (is_dir($path . "/" . $file)) {	
    //                     $folders[] = $path . "/" . $file;
    //                 }
    //                 else { $files[] = $file; }
    //             }
    //         }
    //         // Finally close the directory.
    //         closedir($handle);
    //     }

    //     return($folders);
    //     return($files);
    // }










    /**
     * Creates a tree-structured array of directories and files from a given root folder.
     *
     * Gleaned from: http://stackoverflow.com/questions/952263/deep-recursive-array-of-directory-structure-in-php
     *
     * @param string $dir
     * @param string $regex
     * @param boolean $ignoreEmpty Do not add empty directories to the tree
     * @return array
     */
    function dirtree($dir, $regex='', $ignoreEmpty=false)
    {
        if (!$dir instanceof DirectoryIterator) {
            $dir = new \DirectoryIterator((string)$dir);
        }
        $dirs  = array();
        $files = array();
        foreach ($dir as $node) {
            if ($node->isDir() && !$node->isDot()) {
                $tree = $this->dirtree($node->getPathname(), $regex, $ignoreEmpty);
                if (!$ignoreEmpty || count($tree)) {
                    $dirs[$node->getFilename()] = $tree;
                }
            } elseif ($node->isFile()) {
                $name = $node->getFilename();
                if ('' == $regex || preg_match($regex, $name)) {
                    $files[] = $name;
                }
            }
        }
        asort($dirs);
        sort($files);
    
        return array_merge($dirs, $files);
    }
}
