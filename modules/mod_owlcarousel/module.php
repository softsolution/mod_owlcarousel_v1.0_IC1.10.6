<?php
/* soft-solution.ru created by AlexG */

function mod_owlcarousel($module_id, $cfg){
        $inCore = cmsCore::getInstance();
        $inDB = cmsDatabase::getInstance();
	$cfg = $inCore->loadModuleConfig($module_id);

        $catsql = '';

	if ($cfg['album_id'] != 0) {
            $rootcat = $inDB->get_fields('cms_photo_albums', "id='{$cfg['album_id']}'", 'NSLeft, NSRight');
			if(!$rootcat) { return false; }
            $catsql = " AND a.NSLeft >= {$rootcat['NSLeft']} AND a.NSRight <= {$rootcat['NSRight']}";
        }

	if (!isset($cfg['showtype'])) { $cfg['showtype'] = 'full'; }
	if (!isset($cfg['showmore'])) { $cfg['showmore'] = 1; }


        $sql = "SELECT f.*, a.id as album_id, a.title as album
                        FROM cms_photo_files f
                        LEFT JOIN cms_photo_albums a ON a.id = f.album_id
                        WHERE f.published = 1 ".$catsql."
                        ORDER BY f.id DESC
                        LIMIT ".$cfg['shownum'];

        $result = $inDB->query($sql);
        $is_photo = false;

        if ($inDB->num_rows($result)) {
            $photos = array();
            $is_photo = true;

            while ($con = $inDB->fetch_assoc($result)) {
                $photos[] = $con;
            }
        }

        $smarty = $inCore->initSmarty('modules', 'mod_owlcarousel')->
        assign('photos', $photos)->
        assign('cfg', $cfg)->
        assign('is_photo', $is_photo)->
        display('mod_owlcarousel.tpl');

        return true;

}
?>