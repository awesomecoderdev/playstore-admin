<?php

$icon = get_post_meta(get_the_ID(), "awesomecoder_app_icon", true);
$downloads = get_post_meta(get_the_ID(), "awesomecoder_app_downloads", true);
$stars = get_post_meta(get_the_ID(), "awesomecoder_app_stars", true);
$ratings = get_post_meta(get_the_ID(), "awesomecoder_app_ratings", true);
$devName = get_post_meta(get_the_ID(), "awesomecoder_app_devName", true);
$devLink = get_post_meta(get_the_ID(), "awesomecoder_app_devLink", true);

?>
<div class="animate-spin hidden"></div>
<div id="awesomecoderMetabox" class="awesomecoder w-full shadow rounded-md borderborder-slate-500/20 p-4">
</div>