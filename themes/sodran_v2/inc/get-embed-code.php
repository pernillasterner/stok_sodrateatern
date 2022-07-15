<?php


function sodran_v2_get_embed_code($url) {
  $ytRegEx = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
  $vmRegEx = '%(?:vimeo\.com/)(.*)%i';

  $match = [];
  $output = '';

  $type = (strpos($url, 'youtube') !== false) ? 'youtube' : ((strpos($url, 'vimeo') !== false) ? 'vimeo' : null);


  switch ($type) {
    case 'youtube':
      if (preg_match($ytRegEx, $url, $match)) {
        $id = $match[1];


        $output = '<iframe type="text/html" width="1120" height="630"
                    src="https://www.youtube-nocookie.com/embed/'.$id.'?autoplay=1&controls=0&fs=0&loop=1&modestbranding=1&rel=0&showinfo=0&iv_load_policy=3&mute=1&playlist="'.$id.'"
                    frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
      }
      break;
    case 'vimeo':
      if (preg_match($vmRegEx, $url, $match)) {
        $id = $match[1];

        $output = '<iframe type="text/html" width="1120" height="630"
                    src="https://player.vimeo.com/video/'.$id.'?autoplay=1&loop=1&title=0&byline=0&portrait=0"
                    frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';

      }
      break;
  }

  return $output;
}

