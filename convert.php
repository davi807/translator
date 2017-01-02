<?php
namespace ISMAConvert;

function mb_ord($string)#Stackoverflow
{
    if (extension_loaded('mbstring') === true)
    {
    	mb_language('Neutral');
    	mb_internal_encoding('UTF-8');
    	mb_detect_order(array('UTF-8', 'ISO-8859-15', 'ISO-8859-1', 'ASCII'));

    	$result = unpack('N', mb_convert_encoding($string, 'UCS-4BE', 'UTF-8'));

    	if (is_array($result) === true)
    	{
    		return $result[1];
    	}
    }

    return ord($string);
}
function mb_chr($intval)#Stackoverflow
{
  return mb_convert_encoding(pack('n', $intval), 'UTF-8', 'UTF-16BE');
}

/**************************/

function toansi($str){
  $str = (string)$str;
  $len = mb_strlen($str,"UTF-8");
  $res = "";
  for($i=0;$i<$len;++$i){
    $c = mb_substr($str,$i,1,"UTF-8");
    $o = mb_ord($c);
    if($o>=1329 && $o<=1366):
      /*մեծատառեր 1151*/
      $o-=(1151-($o-1329));
    elseif($o>=1377 && $o<=1414):
      /*փոքրատառեր 1198*/
      $o-=(1198-($o-1377));
    else:
      switch($o){
        case 1415: $o = 168; break; 
        case 8226: $o = 183; break; 
        case 1379: $o = 8226; break; 
        case 1370: $o = 39; break; 
        case 1371: $o = 176; break; 
        case 1372: $o = 175; break; 
        case 1373: $o = 170; break; 
        case 1374: $o = 177; break; 
        case 1417: $o = 163; break; 
        case 1418: $o = 173; break; 
        case 171: $o = 167; break; 
        case 187: $o = 166; break; 
        case 44: $o = 171; break; 
        case 46: $o = 169; break; 
        case 8230: $o = 174; break; 
      }
    endif;
    $res .= mb_chr($o);
  }
  return $res;
}
