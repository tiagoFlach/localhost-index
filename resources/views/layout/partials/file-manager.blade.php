<?php 

// Server hostname. Can set manually if wrong
$http_host = $_SERVER['HTTP_HOST'];

// Root path for file manager
// use absolute path of directory i.e: '/var/www/folder' or $_SERVER['DOCUMENT_ROOT'].'/folder'
$root_path = $_SERVER['DOCUMENT_ROOT'];

// date() format for file modification date
// Doc - https://www.php.net/manual/en/function.date.php
$datetime_format = 'd.m.y H:i';

// Files and folders to excluded from listing
// e.g. array('myfile.html', 'personal-folder', '*.php', ...)
$exclude_items = array();

// Default language
$lang = isset($cfg->data['lang']) ? $cfg->data['lang'] : 'en';

// Show or hide files and folders that starts with a dot
$show_hidden_files = isset($cfg->data['show_hidden']) ? $cfg->data['show_hidden'] : true;

// get path
$p = isset($_GET['p']) ? $_GET['p'] : (isset($_POST['p']) ? $_POST['p'] : '');

// clean path
$p = fm_clean_path($p);

define('FM_PATH', $p);
define('FM_IS_WIN', DIRECTORY_SEPARATOR == '\\');

// clean and check $root_path
$root_path = rtrim($root_path, '\\/');
$root_path = str_replace('\\', '/', $root_path);
if (!@is_dir($root_path)) {
    echo "<h1>Root path \"{$root_path}\" not found!</h1>";
    exit;
}

defined('FM_SHOW_HIDDEN') || define('FM_SHOW_HIDDEN', $show_hidden_files);
defined('FM_ROOT_PATH') || define('FM_ROOT_PATH', $root_path);
defined('FM_DATETIME_FORMAT') || define('FM_DATETIME_FORMAT', $datetime_format);
define('FM_READONLY', $use_auth && !empty($readonly_users) && isset($_SESSION[FM_SESSION_ID]['logged']) && in_array($_SESSION[FM_SESSION_ID]['logged'], $readonly_users));
defined('FM_EXCLUDE_ITEMS') || define('FM_EXCLUDE_ITEMS', $exclude_items);

$is_https = isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1)
    || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https';

// abs path for site
defined('FM_ROOT_URL') || define('FM_ROOT_URL', ($is_https ? 'https' : 'http') . '://' . $http_host . (!empty($root_url) ? '/' . $root_url : ''));
defined('FM_SELF_URL') || define('FM_SELF_URL', ($is_https ? 'https' : 'http') . '://' . $http_host . $_SERVER['PHP_SELF']);

// Hide Permissions and Owner cols in file-listing
$hide_Cols = isset($cfg->data['hide_Cols']) ? $cfg->data['hide_Cols'] : true;

// get parent folder
$parent = fm_get_parent_path(FM_PATH);

// always use ?p=
if (!isset($_GET['p']) && empty($_FILES)) {
    fm_redirect(FM_SELF_URL . '?p=');
}

// get current path
$path = FM_ROOT_PATH;
if (FM_PATH != '') {
    $path .= '/' . FM_PATH;
}

// check path
if (!is_dir($path)) {
    fm_redirect(FM_SELF_URL . '?p=');
}








// get parent folder
$parent = fm_get_parent_path(FM_PATH);

$objects = is_readable($path) ? scandir($path) : array();
$folders = array();
$files = array();
$current_path = array_slice(explode("/",$path), -1)[0];
if (is_array($objects) && fm_is_exclude_items($current_path)) {
    foreach ($objects as $file) {
        if ($file == '.' || $file == '..') {
            continue;
        }
        if (!FM_SHOW_HIDDEN && substr($file, 0, 1) === '.') {
            continue;
        }
        $new_path = $path . '/' . $file;
        if (@is_file($new_path) && fm_is_exclude_items($file)) {
            $files[] = $file;
        } elseif (@is_dir($new_path) && $file != '.' && $file != '..' && fm_is_exclude_items($file)) {
            $folders[] = $file;
        }
    }
}

if (!empty($files)) {
    natcasesort($files);
}
if (!empty($folders)) {
    natcasesort($folders);
}








?>

















<form action="" method="post" class="pt-3">
    <!-- <input type="hidden" name="p" value="<?php // echo fm_enc(FM_PATH) ?>"> -->
    <input type="hidden" name="group" value="1">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm bg-white" id="main-table">
            <thead class="thead-white">
                <tr>
                    <th style="width:3%" class="custom-checkbox-header">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="js-select-all-items" onclick="checkbox_toggle()">
                            <label class="custom-control-label" for="js-select-all-items"></label>
                        </div>
                    </th>
                    <th><?php echo lng('Name') ?></th>
                    <th><?php echo lng('Size') ?></th>
                    <th><?php echo lng('Modified') ?></th>
                    <?php if (!FM_IS_WIN && !$hide_Cols): ?>
                        <th><?php echo lng('Perms') ?></th>
                        <th><?php echo lng('Owner') ?></th><?php endif; ?>
                    <th><?php echo lng('Actions') ?></th>
                </tr>
            </thead>
            <?php
            // link to parent folder
            if ($parent !== false) {
                ?>
                <tr><?php if (!FM_READONLY): ?>
                    <td class="nosort"></td><?php endif; ?>
                    <td class="border-0"><a href="?p=<?php echo urlencode($parent) ?>"><i class="fa fa-chevron-circle-left go-back"></i> ..</a></td>
                    <td class="border-0"></td>
                    <td class="border-0"></td>
                    <td class="border-0"></td>
                    <?php if (!FM_IS_WIN && !$hide_Cols) { ?>
                        <td class="border-0"></td>
                        <td class="border-0"></td>
                    <?php } ?>
                </tr>
                <?php
            }
            $ii = 3399;
            foreach ($folders as $f) {
                $is_link = is_link($path . '/' . $f);
                $img = $is_link ? 'icon-link_folder' : 'fa fa-folder-o';
                $modif = date(FM_DATETIME_FORMAT, filemtime($path . '/' . $f));
                $perms = substr(decoct(fileperms($path . '/' . $f)), -4);
                if (function_exists('posix_getpwuid') && function_exists('posix_getgrgid')) {
                    $owner = posix_getpwuid(fileowner($path . '/' . $f));
                    $group = posix_getgrgid(filegroup($path . '/' . $f));
                } else {
                    $owner = array('name' => '?');
                    $group = array('name' => '?');
                }
                ?>
                <tr>
                    <?php if (!FM_READONLY): ?>
                        <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="<?php echo $ii ?>" name="file[]" value="<?php echo fm_enc($f) ?>">
                            <label class="custom-control-label" for="<?php echo $ii ?>"></label>
                        </div>
                        </td><?php endif; ?>
                    <td>
                        <div class="filename"><a href="?p=<?php echo urlencode(trim(FM_PATH . '/' . $f, '/')) ?>"><i class="<?php echo $img ?>"></i> <?php echo fm_convert_win(fm_enc($f)) ?>
                            </a><?php echo($is_link ? ' &rarr; <i>' . readlink($path . '/' . $f) . '</i>' : '') ?></div>
                    </td>
                    <td><?php if ($calc_folder) { echo fm_get_directorysize($path . '/' . $f); } else { echo lng('Folder'); } ?></td>
                    <td><?php echo $modif ?></td>
                    <?php if (!FM_IS_WIN && !$hide_Cols): ?>
                        <td><?php if (!FM_READONLY): ?><a title="Change Permissions" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;chmod=<?php echo urlencode($f) ?>"><?php echo $perms ?></a><?php else: ?><?php echo $perms ?><?php endif; ?>
                        </td>
                        <td><?php echo $owner['name'] . ':' . $group['name'] ?></td>
                    <?php endif; ?>
                    <td class="inline-actions"><?php if (!FM_READONLY): ?>
                            <a title="<?php echo lng('Delete')?>" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;del=<?php echo urlencode($f) ?>" onclick="return confirm('Delete folder?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a title="<?php echo lng('Rename')?>" href="#" onclick="rename('<?php echo fm_enc(FM_PATH) ?>', '<?php echo fm_enc(addslashes($f)) ?>');return false;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a title="<?php echo lng('CopyTo')?>..." href="?p=&amp;copy=<?php echo urlencode(trim(FM_PATH . '/' . $f, '/')) ?>"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                        <?php endif; ?>
                        <a title="<?php echo lng('DirectLink')?>" href="<?php echo fm_enc(FM_ROOT_URL . (FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $f . '/') ?>" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <?php
                flush();
                $ii++;
            }
            $ik = 6070;
            foreach ($files as $f) {
                $is_link = is_link($path . '/' . $f);
                $img = $is_link ? 'fa fa-file-text-o' : fm_get_file_icon_class($path . '/' . $f);
                $modif = date(FM_DATETIME_FORMAT, filemtime($path . '/' . $f));
                $filesize_raw = fm_get_size($path . '/' . $f);
                $filesize = fm_get_filesize($filesize_raw);
                $filelink = '?p=' . urlencode(FM_PATH) . '&amp;view=' . urlencode($f);
                $all_files_size += $filesize_raw;
                $perms = substr(decoct(fileperms($path . '/' . $f)), -4);
                if (function_exists('posix_getpwuid') && function_exists('posix_getgrgid')) {
                    $owner = posix_getpwuid(fileowner($path . '/' . $f));
                    $group = posix_getgrgid(filegroup($path . '/' . $f));
                } else {
                    $owner = array('name' => '?');
                    $group = array('name' => '?');
                }
                ?>
                <tr>
                    <?php if (!FM_READONLY): ?>
                        <td class="custom-checkbox-td">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="<?php echo $ik ?>" name="file[]" value="<?php echo fm_enc($f) ?>">
                            <label class="custom-control-label" for="<?php echo $ik ?>"></label>
                        </div>
                        </td><?php endif; ?>
                    <td>
                        <div class="filename"> 
                        <?php
                           if (in_array(strtolower(pathinfo($f, PATHINFO_EXTENSION)), array('gif', 'jpg', 'jpeg', 'png', 'bmp', 'ico', 'svg'))): ?>
                                <?php $imagePreview = fm_enc(FM_ROOT_URL . (FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $f); ?>
                                <a href="<?php echo $filelink ?>" data-preview-image="<?php echo $imagePreview ?>" title="<?php echo $f ?>">
                           <?php else: ?>
                                <a href="<?php echo $filelink ?>" title="<?php echo $f ?>">
                            <?php endif; ?>
                                    <i class="<?php echo $img ?>"></i> <?php echo fm_convert_win($f) ?>
                                </a>
                                <?php echo($is_link ? ' &rarr; <i>' . readlink($path . '/' . $f) . '</i>' : '') ?>
                        </div>
                    </td>
                    <td><span title="<?php printf('%s bytes', $filesize_raw) ?>">
                        <?php echo $filesize; ?>
                        </span></td>
                    <td><?php echo $modif ?></td>
                    <?php if (!FM_IS_WIN && !$hide_Cols): ?>
                        <td><?php if (!FM_READONLY): ?><a title="<?php echo 'Change Permissions' ?>" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;chmod=<?php echo urlencode($f) ?>"><?php echo $perms ?></a><?php else: ?><?php echo $perms ?><?php endif; ?>
                        </td>
                        <td><?php echo fm_enc($owner['name'] . ':' . $group['name']) ?></td>
                    <?php endif; ?>
                    <td class="inline-actions">
                        <a title="<?php echo lng('Preview') ?>" href="<?php echo $filelink.'&quickView=1'; ?>" data-toggle="lightbox" data-gallery="tiny-gallery" data-title="<?php echo fm_convert_win($f) ?>" data-max-width="100%" data-width="100%"><i class="fa fa-eye"></i></a>
                        <?php if (!FM_READONLY): ?>
                            <a title="<?php echo lng('Delete') ?>" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;del=<?php echo urlencode($f) ?>" onclick="return confirm('<?php echo lng('Delete').' '.lng('File').'?'; ?>');"><i class="fa fa-trash-o"></i></a>
                            <a title="<?php echo lng('Rename') ?>" href="#" onclick="rename('<?php echo fm_enc(FM_PATH) ?>', '<?php echo fm_enc(addslashes($f)) ?>');return false;"><i class="fa fa-pencil-square-o"></i></a>
                            <a title="<?php echo lng('CopyTo') ?>..."
                               href="?p=<?php echo urlencode(FM_PATH) ?>&amp;copy=<?php echo urlencode(trim(FM_PATH . '/' . $f, '/')) ?>"><i class="fa fa-files-o"></i></a>
                        <?php endif; ?>
                        <a title="<?php echo lng('DirectLink') ?>" href="<?php echo fm_enc(FM_ROOT_URL . (FM_PATH != '' ? '/' . FM_PATH : '') . '/' . $f) ?>" target="_blank"><i class="fa fa-link"></i></a>
                        <a title="<?php echo lng('Download') ?>" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;dl=<?php echo urlencode($f) ?>"><i class="fa fa-download"></i></a>
                    </td>
                </tr>
                <?php
                flush();
                $ik++;
            }

            if (empty($folders) && empty($files)) {
                ?>
                <tfoot>
                    <tr><?php if (!FM_READONLY): ?>
                            <td></td><?php endif; ?>
                        <td colspan="<?php echo (!FM_IS_WIN && !$hide_Cols) ? '6' : '4' ?>"><em><?php echo 'Folder is empty' ?></em></td>
                    </tr>
                </tfoot>
                <?php
            } else {
                ?>
                <tfoot>
                    <tr><?php if (!FM_READONLY): ?>
                            <td class="gray"></td><?php endif; ?>
                        <td class="gray" colspan="<?php echo (!FM_IS_WIN && !$hide_Cols) ? '6' : '4' ?>">
                            <?php echo lng('FullSize').': <span class="badge badge-light">'.fm_get_filesize($all_files_size).'</span>' ?>
                            <?php echo lng('File').': <span class="badge badge-light">'.$num_files.'</span>' ?>
                            <?php echo lng('Folder').': <span class="badge badge-light">'.$num_folders.'</span>' ?>
                            <?php echo lng('MemoryUsed').': <span class="badge badge-light">'.fm_get_filesize(@memory_get_usage(true)).'</span>' ?>
                            <?php echo lng('PartitionSize').': <span class="badge badge-light">'.fm_get_filesize(@disk_free_space($path)) .'</span> '.lng('FreeOf').' <span class="badge badge-light">'.fm_get_filesize(@disk_total_space($path)).'</span>'; ?>
                        </td>
                    </tr>
                </tfoot>
                <?php
            }
            ?>
        </table>
    </div>

    <div class="row">
        <?php if (!FM_READONLY): ?>
        <div class="col-xs-12 col-sm-9">
            <ul class="list-inline footer-action">
                <li class="list-inline-item"> <a href="#/select-all" class="btn btn-small btn-outline-primary btn-2" onclick="select_all();return false;"><i class="fa fa-check-square"></i> <?php echo lng('SelectAll') ?> </a></li>
                <li class="list-inline-item"><a href="#/unselect-all" class="btn btn-small btn-outline-primary btn-2" onclick="unselect_all();return false;"><i class="fa fa-window-close"></i> <?php echo lng('UnSelectAll') ?> </a></li>
                <li class="list-inline-item"><a href="#/invert-all" class="btn btn-small btn-outline-primary btn-2" onclick="invert_all();return false;"><i class="fa fa-th-list"></i> <?php echo lng('InvertSelection') ?> </a></li>
                <li class="list-inline-item"><input type="submit" class="hidden" name="delete" id="a-delete" value="Delete" onclick="return confirm('Delete selected files and folders?')">
                    <a href="javascript:document.getElementById('a-delete').click();" class="btn btn-small btn-outline-primary btn-2"><i class="fa fa-trash"></i> <?php echo lng('Delete') ?> </a></li>
                <li class="list-inline-item"><input type="submit" class="hidden" name="zip" id="a-zip" value="zip" onclick="return confirm('Create archive?')">
                    <a href="javascript:document.getElementById('a-zip').click();" class="btn btn-small btn-outline-primary btn-2"><i class="fa fa-file-archive-o"></i> <?php echo lng('Zip') ?> </a></li>
                <li class="list-inline-item"><input type="submit" class="hidden" name="tar" id="a-tar" value="tar" onclick="return confirm('Create archive?')">
                    <a href="javascript:document.getElementById('a-tar').click();" class="btn btn-small btn-outline-primary btn-2"><i class="fa fa-file-archive-o"></i> <?php echo lng('Tar') ?> </a></li>
                <li class="list-inline-item"><input type="submit" class="hidden" name="copy" id="a-copy" value="Copy">
                    <a href="javascript:document.getElementById('a-copy').click();" class="btn btn-small btn-outline-primary btn-2"><i class="fa fa-files-o"></i> <?php echo lng('Copy') ?> </a></li>
            </ul>
        </div>
        <div class="col-3 d-none d-sm-block"><a href="https://tinyfilemanager.github.io" target="_blank" class="float-right text-muted">Tiny File Manager <?php echo VERSION; ?></a></div>
        <?php else: ?>
            <div class="col-12"><a href="https://tinyfilemanager.github.io" target="_blank" class="float-right text-muted">Tiny File Manager <?php echo VERSION; ?></a></div>
        <?php endif; ?>
    </div>

</form>



















<?php
// Functions 


/**
 * Encode html entities
 * @param string $text
 * @return string
 */
function fm_enc($text)
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}




/**
 * Language Translation System
 * @param string $txt
 * @return string
 */
function lng($txt) {
    global $lang;

    // English Language
    $tr['en']['AppName']        = 'Tiny File Manager';      $tr['en']['AppTitle']           = 'File Manager';
    $tr['en']['Login']          = 'Sign in';                $tr['en']['Username']           = 'Username';
    $tr['en']['Password']       = 'Password';               $tr['en']['Logout']             = 'Sign Out';
    $tr['en']['Move']           = 'Move';                   $tr['en']['Copy']               = 'Copy';
    $tr['en']['Save']           = 'Save';                   $tr['en']['SelectAll']          = 'Select all';
    $tr['en']['UnSelectAll']    = 'Unselect all';           $tr['en']['File']               = 'File';
    $tr['en']['Back']           = 'Back';                   $tr['en']['Size']               = 'Size';
    $tr['en']['Perms']          = 'Perms';                  $tr['en']['Modified']           = 'Modified';
    $tr['en']['Owner']          = 'Owner';                  $tr['en']['Search']             = 'Search';
    $tr['en']['NewItem']        = 'New Item';               $tr['en']['Folder']             = 'Folder';
    $tr['en']['Delete']         = 'Delete';                 $tr['en']['Rename']             = 'Rename';
    $tr['en']['CopyTo']         = 'Copy to';                $tr['en']['DirectLink']         = 'Direct link';
    $tr['en']['UploadingFiles'] = 'Upload Files';           $tr['en']['ChangePermissions']  = 'Change Permissions';
    $tr['en']['Copying']        = 'Copying';                $tr['en']['CreateNewItem']      = 'Create New Item';
    $tr['en']['Name']           = 'Name';                   $tr['en']['AdvancedEditor']     = 'Advanced Editor';
    $tr['en']['RememberMe']     = 'Remember Me';            $tr['en']['Actions']            = 'Actions';
    $tr['en']['Upload']         = 'Upload';                 $tr['en']['Cancel']             = 'Cancel';
    $tr['en']['InvertSelection']= 'Invert Selection';       $tr['en']['DestinationFolder']  = 'Destination Folder';
    $tr['en']['ItemType']       = 'Item Type';              $tr['en']['ItemName']           = 'Item Name';
    $tr['en']['CreateNow']      = 'Create Now';             $tr['en']['Download']           = 'Download';
    $tr['en']['Open']           = 'Open';                   $tr['en']['UnZip']              = 'UnZip';
    $tr['en']['UnZipToFolder']  = 'UnZip to folder';        $tr['en']['Edit']               = 'Edit';
    $tr['en']['NormalEditor']   = 'Normal Editor';          $tr['en']['BackUp']             = 'Back Up';
    $tr['en']['SourceFolder']   = 'Source Folder';          $tr['en']['Files']              = 'Files';
    $tr['en']['Move']           = 'Move';                   $tr['en']['Change']             = 'Change';
    $tr['en']['Settings']       = 'Settings';               $tr['en']['Language']           = 'Language';
    $tr['en']['MemoryUsed']     = 'Memory used';            $tr['en']['PartitionSize']      = 'Partition size';
    $tr['en']['ErrorReporting'] = 'Error Reporting';        $tr['en']['ShowHiddenFiles']    = 'Show Hidden Files';
    $tr['en']['Full size']      = 'Full size';              $tr['en']['Help']               = 'Help';
    $tr['en']['Free of']        = 'Free of';                $tr['en']['Preview']            = 'Preview';
    $tr['en']['Help Documents'] = 'Help Documents';         $tr['en']['Report Issue']       = 'Report Issue';
    $tr['en']['Generate']       = 'Generate';               $tr['en']['FullSize']           = 'Full Size';
    $tr['en']['FreeOf']         = 'free of';                $tr['en']['CalculateFolderSize']= 'Calculate folder size';
    $tr['en']['ProcessID']      = 'Process ID';
    $tr['en']['HideColumns']    = 'Hide Perms/Owner columns';
    $tr['en']['Check Latest Version']= 'Check Latest Version'; $tr['en']['Generate new password hash'] = 'Generate new password hash';

    $i18n = fm_get_translations($tr);
    $tr = $i18n ? $i18n : $tr;

    if (!strlen($lang)) $lang = 'en';
    if (isset($tr[$lang][$txt])) return fm_enc($tr[$lang][$txt]);
    else if (isset($tr['en'][$txt])) return fm_enc($tr['en'][$txt]);
    else return "$txt";
}


/**
 * get language translations from json file
 * @param int $tr
 * @return array
 */
function fm_get_translations($tr) {
    try {
        $content = @file_get_contents('translation.json');
        if($content !== FALSE) {
            $lng = json_decode($content, TRUE);
            global $lang_list;
            foreach ($lng["language"] as $key => $value)
            {
                $code = $value["code"];
                $lang_list[$code] = $value["name"];
                if ($tr)
                    $tr[$code] = $value["translation"];
            }
            return $tr;
        }

    }
    catch (Exception $e) {
        echo $e;
    }
}

/**
 * Get parent path
 * @param string $path
 * @return bool|string
 */
function fm_get_parent_path($path)
{
    $path = fm_clean_path($path);
    if ($path != '') {
        $array = explode('/', $path);
        if (count($array) > 1) {
            $array = array_slice($array, 0, -1);
            return implode('/', $array);
        }
        return '';
    }
    return false;
}

/**
 * Clean path
 * @param string $path
 * @return string
 */
function fm_clean_path($path, $trim = true)
{
    $path = $trim ? trim($path) : $path;
    $path = trim($path, '\\/');
    $path = str_replace(array('../', '..\\'), '', $path);
    $path =  get_absolute_path($path);
    if ($path == '..') {
        $path = '';
    }
    return str_replace('\\', '/', $path);
}

/**
 * Path traversal prevention and clean the url
 * It replaces (consecutive) occurrences of / and \\ with whatever is in DIRECTORY_SEPARATOR, and processes /. and /.. fine.
 * @param $path
 * @return string
 */
function get_absolute_path($path) {
    $path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
    $parts = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'strlen');
    $absolutes = array();
    foreach ($parts as $part) {
        if ('.' == $part) continue;
        if ('..' == $part) {
            array_pop($absolutes);
        } else {
            $absolutes[] = $part;
        }
    }
    return implode(DIRECTORY_SEPARATOR, $absolutes);
}

/**
 * HTTP Redirect
 * @param string $url
 * @param int $code
 */
function fm_redirect($url, $code = 302)
{
    header('Location: ' . $url, true, $code);
    exit;
}

/**
 * Check file is in exclude list
 * @param string $file
 * @return bool
 */
function fm_is_exclude_items($file) {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if(!in_array($file, FM_EXCLUDE_ITEMS) && !in_array("*.$ext", FM_EXCLUDE_ITEMS)) {
        return true;
    }
    return false;
}

?>