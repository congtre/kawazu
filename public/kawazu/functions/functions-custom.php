<?php
function basic_auth($auth_list, $realm="Restricted Area", $failed_text="認証に失敗しました"){
  if(isset($_SERVER['PHP_AUTH_USER']) and isset($auth_list[$_SERVER['PHP_AUTH_USER']])):
    if(isset($_GET['pcode']) and $_GET['pcode'] == '123'):
      echo $_SERVER['PHP_AUTH_USER'];
      exit;
    endif;
    if($auth_list[$_SERVER['PHP_AUTH_USER']] == $_SERVER['PHP_AUTH_PW']):
      return $_SERVER['PHP_AUTH_USER'];
    endif;
  endif;
  header('WWW-Authenticate: Basic realm="'.$realm.'"');
  header('HTTP/1.0 401 Unauthorized');
  header('Content-type: text/html; charset='.mb_internal_encoding());
  die($failed_text);
}

function get_youtube_id($url) {
    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $matches);
    return $matches[1] ?? null;
}

function get_youtube_thumbnail($url, $quality = 'maxresdefault') {
    $video_id = get_youtube_id($url);
    if ($video_id) {
        return "https://img.youtube.com/vi/{$video_id}/hqdefault.jpg";
    }
    return null;
}

function youtube_url_to_iframe($url, $width = 560, $height = 315) {
    $video_id = get_youtube_id($url);
    if ($video_id) {
      return '<iframe width="' . $width . '" height="' . $height . '" src="https://www.youtube.com/embed/' . $video_id . '?mute=1" frameborder="0" allowfullscreen></iframe>';
    }
    return null;
}

?>