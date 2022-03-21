<?
session_start();
$type = $_POST['type'];
switch ($type) {
    case 'maxilla_image':
        unset( $_SESSION['maxilla_image']);
        break;
    case 'mandible_image':
         unset( $_SESSION['mandible_image']);
        break;
    case 'lateral_photo':
         unset( $_SESSION['lateral_photo']);
        break;
    case 'front_photo':
         unset( $_SESSION['front_photo']);
        break;
    case 'smile_photo':
         unset( $_SESSION['smile_photo']);
        break;
    case 'intraoral_upper':
         unset( $_SESSION['intraoral_upper']);
        break;

    case 'intraoral_lower':
         unset( $_SESSION['intraoral_lower']);
        break;

    case 'intraoral_right':
         unset( $_SESSION['intraoral_right']);
        break;

    case 'intraoral_left':
         unset( $_SESSION['intraoral_left']);
        break;

    case 'intraoral_fornt':
         unset( $_SESSION['intraoral_fornt']);
        break;

    case 'lateral_xray':
         unset( $_SESSION['lateral_xray']);
        break;
        
    case 'panorama':
         unset( $_SESSION['panorama']);
        break;

    
    default:
        # code...
        break;
}








?>