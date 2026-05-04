<?php

/******************************************************/
function add_image($type, $id, $image, $filename, &$new_filename)
{
    $new_filename = '';
	if (!$id || !$image || !$filename)
	{
		return 'Ungültige Bilddaten';
	}
	$extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
	switch ($extension)
	{
		case "jpg";
		case "jpeg";
		case "png";
		case "gif";
		case "avif":
		case "bmp":
			break;
		default:
			return 'Ungültiges Bildformat '. $extension;
	}
			
	$new_filename = uniqid(). '.' . $extension;
	switch($type)
	{
        case GLB_IMAGE_TYPE_USER:
            $error = save_to_jpeg('img/user/tmp/', $new_filename, $image);
            if ($error != '')
            {
                return $error;
            }
            make_thumb('img/user/tmp/', $new_filename, 'img/user/' , $new_filename, GLB_IMAGE_SIZE_ARTICLE_MEDIUM);
            unlink_image('img/user/tmp/' . $new_filename);
            $new_filename = 'img/user/' . $new_filename;
            break;
        case GLB_IMAGE_TYPE_ASSOCIATION:
            $error = save_to_jpeg('img/association/tmp/', $new_filename, $image);
            if ($error != '')
            {
                return $error;
            }
            make_thumb('img/association/tmp/', $new_filename, 'img/association/'. $id . '/thumbs/', $new_filename, GLB_IMAGE_SIZE_ARTICLE_THUMB);
            make_thumb('img/association/tmp/', $new_filename, 'img/association/'. $id . '/medium/', $new_filename, GLB_IMAGE_SIZE_ARTICLE_MEDIUM);
            unlink_image('img/association/tmp/' . $new_filename);
            $new_filename = 'img/user/' . $new_filename;
            break;
		default:
			return 'Unbekannter Typ';
	}
	return '';
}

function getXmpData($filename, $chunk_size = 50000){
    $buffer = NULL;
    if (($file_pointer = fopen($filename, 'r')) === FALSE) {
        throw new RuntimeException('Could not open file for reading');
    }

    $chunk = fread($file_pointer, $chunk_size);
    if (($posStart = strpos($chunk, '<x:xmpmeta')) !== FALSE) {
        $buffer = substr($chunk, $posStart);
         $posEnd = strpos($buffer, '</x:xmpmeta>');
        $buffer = substr($buffer, 0, $posEnd + 12);
    }

    fclose($file_pointer);

// recursion here
      if(!strpos($buffer, '</x:xmpmeta>')){
        $buffer = NULL;
    }
    return $buffer;
}

function get_xmp_data($xmp, $tag)
{
    $value = '';
    if (($posStart = strpos($xmp, $tag)) !== FALSE)
    {
        $value = substr($xmp, $posStart + strlen($tag) + 2);
        $posEnd = strpos($value, '"');
        $value = substr($value, 0, $posEnd);
    }
    return $value;
}

function get_xmp_rdf_tag_value($xmp, $tag)
{
    $rdf_tag = '';
    if (($posStart = strpos($xmp, '<' . $tag)) !== FALSE)
    {
        $rdf_tag = substr($xmp, $posStart);
        $posEnd = strpos($rdf_tag, '</' . $tag);
        $rdf_tag = substr($rdf_tag, 0, $posEnd);
    }
    $value = '';
    if ($rdf_tag != '')
    {
        if (($posStart = strpos($rdf_tag, '<rdf:li>')) !== FALSE)
        {
            $value = substr($rdf_tag, $posStart + 8);
            $posEnd = strpos($value, '</rdf:li>');
            $value = substr($value, 0, $posEnd);
        }

    }
    return $value;

}

function get_image_type_path($type)
{
	switch($type)
	{
		case GLB_IMAGE_TYPE_ARTICLE:
			return 'img/articles/';
		case GLB_IMAGE_TYPE_PRESS_LINK:
			return 'img/press_link/';
		case GLB_IMAGE_TYPE_MANUFACTURER:
			return 'img/manufacturer/';
		case GLB_IMAGE_TYPE_PUZZLE:
			return 'img/puzzle/';
		case GLB_IMAGE_TYPE_SPONSOR:
			return 'img/sponsor/';
		case GLB_IMAGE_TYPE_EVENT_GALLERY:
			return 'img/image/';
        case GLB_IMAGE_TYPE_ASSOCIATION:
            return 'img/association/';
        case GLB_IMAGE_TYPE_MEETING_APPOINTMENT:
            return 'img/meeting_appointment/';
		case GLB_IMAGE_TYPE_SOCIAL_PROJECT_SPONSOR:
            return 'img/social_project_sponsor/';
        case GLB_IMAGE_TYPE_SOCIAL_PROJECT_REPORT:
            return 'img/social_project_report/';
		default:
			return 'img/';
	}
}

function delete_image_file($type, $id, $filename, $original_name = '')
{
	if (!$id || !$filename)
	{
		return 'Ungültige Bilddaten';
	}
	switch($type)
	{
		case GLB_IMAGE_TYPE_ARTICLE:
            unlink_image('img/articles/'. $id . '/thumbs/' . $filename);
            unlink_image('img/articles/'. $id . '/medium/' . $filename);
            unlink_image('img/articles/'. $id . '/large/' . $filename);
			if ($original_name != '')
			{
                unlink_image('img/articles/'. $id . '/originals/' . $original_name);
			}
			break;
		case GLB_IMAGE_TYPE_PRESS_LINK:
            unlink_image('img/press_link/'. $id . '/thumbs/' . $filename);
            unlink_image('img/press_link/'. $id . '/large/' . $filename);
			if ($original_name != '')
			{
                unlink_image('img/press_link/'. $id . '/originals/' . $original_name);
			}
			break;
		case GLB_IMAGE_TYPE_MANUFACTURER:
            unlink_image('img/manufacturer/'. $id . '/thumbs/' . $filename);
            unlink_image('img/manufacturer/'. $id . '/large/' . $filename);
			if ($original_name != '')
			{
                unlink_image('img/manufacturer/'. $id . '/originals/' . $original_name);
			}
			break;
		case GLB_IMAGE_TYPE_PUZZLE:
            unlink_image('img/puzzle/'. $id . '/thumbs/' . $filename);
            unlink_image('img/puzzle/'. $id . '/medium/' . $filename);
            unlink_image('img/puzzle/'. $id . '/large/' . $filename);
			if ($original_name != '')
			{
                unlink_image('img/puzzle/'. $id . '/originals/' . $original_name);
			}
			break;
		case GLB_IMAGE_TYPE_SPONSOR:
            unlink_image('img/sponsor/'. $id . '/thumbs/' . $filename);
            unlink_image('img/sponsor/'. $id . '/large/' . $filename);
			if ($original_name != '')
			{
                unlink_image('img/sponsor/'. $id . '/originals/' . $original_name);
			}
			break;
		case GLB_IMAGE_TYPE_EVENT_GALLERY:
			unlink_image('img/image/'. $id . '/thumbs/' . $filename);
			unlink_image('img/image/'. $id . '/large/' . $filename);
			if ($original_name != '')
			{
				unlink_image('img/image/'. $id . '/originals/' . $original_name);
			}
			break;
        case GLB_IMAGE_TYPE_ASSOCIATION:
            unlink_image('img/association/'. $id . '/thumbs/' . $filename);
            unlink_image('img/association/'. $id . '/medium/' . $filename);
            if ($original_name != '')
            {
                unlink_image('img/association/'. $id . '/originals/' . $original_name);
            }
            break;
        case GLB_IMAGE_TYPE_MEETING_APPOINTMENT:
            unlink_image('img/meeting_appointment/'. $id . '/thumbs/' . $filename);
            unlink_image('img/meeting_appointment/'. $id . '/large/' . $filename);
            if ($original_name != '')
            {
                unlink_image('img/meeting_appointment/'. $id . '/originals/' . $original_name);
            }
            break;
        case GLB_IMAGE_TYPE_SOCIAL_PROJECT_SPONSOR:
            unlink_image('img/social_project_sponsor/'. $id . '/thumbs/' . $filename);
            unlink_image('img/social_project_sponsor/'. $id . '/large/' . $filename);
            if ($original_name != '')
            {
                unlink_image('img/social_project_sponsor/'. $id . '/originals/' . $original_name);
            }
            break;
        case GLB_IMAGE_TYPE_SOCIAL_PROJECT_REPORT:
            unlink_image('img/social_project_report/'. $id . '/thumbs/' . $filename);
            unlink_image('img/social_project_report/'. $id . '/large/' . $filename);
            if ($original_name != '')
            {
                unlink_image('img/social_project_report/'. $id . '/originals/' . $original_name);
            }
            break;
		default:
			return 'Unbekannter Typ';
	}
	return '';
}


function unlink_image($file)
{
	if (file_exists($file))
	{
		unlink($file);
	}
}

function delete_image_path($type, $id)
{
	if (!$id)
	{
		return 'Ungültige Bilddaten';
	}
	rrmdir(get_image_type_path($type). $id );
	return '';
}

function rrmdir($src) {
	if (is_dir($src))
	{
		$dir = opendir($src);
		while(false !== ( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				$full = $src . '/' . $file;
				if ( is_dir($full) ) {
					rrmdir($full);
				}
				else {
					unlink($full);
				}
			}
		}
		closedir($dir);
		rmdir($src);
	}
}

function move_image_path($type, $id, $newid)
{
	if (!$id)
	{
		return 'Ungültige Bilddaten';
	}
    switch($type)
    {
        case GLB_IMAGE_TYPE_SOCIAL_PROJECT_REPORT:
            $sql = "UPDATE image SET ref_id = '$newid' WHERE ref_id='$id' AND type='$type'";
            query($sql);
            break;
    }
	$path = get_image_type_path($type);
	rename($path. $id, $path. $newid);
	return '';
}

function create_tmp_image_dir($type)
{
	$id = -10;
	$path = get_image_type_path($type);
	while (file_exists($path . $id))
	{
		$id--;
	}
	mkdir($path . $id, 0777, true);
	return $id;	
}

function save_to_jpeg($path, $filename, $base64_string)
{
	if (!file_exists($path)) {
		mkdir($path, 0777, true);
	}
    $data = explode(',', $base64_string);
	if (substr($data[0], 0, 11) != 'data:image/')
	{
		return 'Ungültiges Bildformat ' . $data[0];
	}
    $ifp = fopen($path . $filename, "wb"); 
    fwrite($ifp, base64_decode($data[1])); 
    fclose($ifp); 
	return '';
}

function check_rotation($filename)
{
    $exif = @exif_read_data($filename, null, true);
    if (!isset($exif['IFD0']) || !isset($exif['IFD0']['Orientation']))
    {
//        print_r($exif);
        return;
    }
    $deg = 0;
    switch ($exif['IFD0']['Orientation']) {
        case 3:
            $deg = 180;
            break;
        case 6:
            $deg = 270;
            break;
        case 8:
            $deg = 90;
            break;
    }
    if ($deg) {
        $img = imagecreatefromjpeg($filename);
        $img = imagerotate($img, $deg, 0);
        imagejpeg($img, $filename, 95);

    }
}

function make_thumb($src_path, $src_filename, $dest_path, $dest_filename, $desired_width) {
    try
    {
		if (!file_exists($dest_path)) {
			mkdir($dest_path, 0777, true);
		}
		/* read the source image */
		$extension = strtolower(pathinfo($src_filename, PATHINFO_EXTENSION));
		switch($extension)
		{
			case 'avif':
				$source_image = imagecreatefromavif($src_path . $src_filename);
				break;
			case 'bmp':
				$source_image = imagecreatefrombmp($src_path . $src_filename);
				break;
			case 'gif':
				$source_image = imagecreatefromgif($src_path . $src_filename);
				break;
			case 'png':
				$source_image = imagecreatefrompng($src_path . $src_filename);
				break;
			case 'jpg':
			case 'jpeg':
				$source_image = imagecreatefromjpeg($src_path . $src_filename);
				break;
			default:
				copy('img/placeholder.jpeg', $dest_path . $dest_filename);
				return;
				
			
		}
		$width = imagesx($source_image);
		$height = imagesy($source_image);
		
            if ( $width > $desired_width || $height > $desired_width ) {
                $ratio = $width/$height;
                if( $ratio > 1) {
                    $new_width = $desired_width;
                    $new_height = $desired_width/$ratio;
                } else {
                    $new_width = $desired_width*$ratio;
                    $new_height = $desired_width;
                }
            }
            else
            {
                $new_width = $width;
                $new_height = $height;
            }
            $virtual_image = imagecreatetruecolor( $new_width, $new_height );






        $trans_colour = imagecolorallocatealpha($virtual_image , 0, 0, 0, 127);
//        imagecolortransparent($virtual_image, $trans_colour);
        imagealphablending($virtual_image, false);
        imagesavealpha($virtual_image, true);
        imagefill($virtual_image, 0, 0, $trans_colour);
		
		
		
		/* copy source image at a resized size */
		imagecopyresampled( $virtual_image, $source_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
//		imagecopyresampled($virtual_image, $source_image, 0, 0, $src_x, $src_y, $desired_width, $desired_width, $src_width, $src_height);
		
		/* create the physical thumbnail image to its destination */
		
		switch($extension)
		{
			case 'avif':
				imageavif($virtual_image, $dest_path . $dest_filename);
				break;
			case 'bmp':
				imagebmp($virtual_image, $dest_path . $dest_filename);
				break;
			case 'gif':
				imagegif($virtual_image, $dest_path . $dest_filename);
				break;
			case 'png':
				imagepng($virtual_image, $dest_path . $dest_filename);
				break;
			case 'jpg':
			case 'jpeg':
				imagejpeg($virtual_image, $dest_path . $dest_filename);
				break;
			default:
				break;
		}
	}
    catch(Exception $e)
    {
        copy('img/placeholder.jpeg', $dest_path . $dest_filename);
    }
}


function get_dir_images($dir)
{
	$image_extensions = array("png","jpg","jpeg","gif","bmp","avif");
	$files = array();
	
	// Target directory
	if (is_dir($dir))
	{
		if ($dh = opendir($dir))
		{
			// Read files
			while (($file = readdir($dh)) !== false)
			{
				if($file != '' && $file != '.' && $file != '..' && $file != 'thumbnail'&& $file != 'original')
				{
					$image_path = $dir.$file;
					$image_ext = pathinfo($image_path, PATHINFO_EXTENSION);
					if (!is_dir($image_path) && in_array(strtolower($image_ext),$image_extensions))
					{
						$files[] = $image_path;
					}
				}
			}
			closedir($dh);
		}
	}
	return $files;
}
