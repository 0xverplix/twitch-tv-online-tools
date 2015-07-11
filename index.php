<?php

if (isset($_POST['channel']) && preg_match("/^[a-zA-Z0-9_]{4,25}$/u", $_POST['channel'])) {
    $url = sprintf('https://api.twitch.tv/api/channels/%s/access_token/', $_POST['channel']);
    $page = file_get_contents($url);
    $json = json_decode($page, true);

    $token = $json['token'];
    $sig = $json['sig'];

    $stream = 'http://usher.twitch.tv/api/channel/hls/' . $_POST['channel'] . '.m3u8?player=twitchweb&token=' . rawurlencode($token) . '&sig=' . $sig;

    echo 'watch <a href="' . $stream . '">' . $_POST['channel'] . '</a> channel';
}
