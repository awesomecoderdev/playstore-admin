<?php
$awesomecoderLicenceProduct = get_post_meta(get_the_ID(), "awesomecoderLicenceProduct", true);
$awesomecoderLicenceProduct = $awesomecoderLicenceProduct ? $awesomecoderLicenceProduct : "false";
$awesomecoderLicenceProduct = $awesomecoderLicenceProduct == "true" ? "true" : "false";
?>
<script>
    const awesomecoderLicenceProduct = <?php echo $awesomecoderLicenceProduct; ?>;
</script>
<div id="awesomecoderProductMetabox" class="awesomecoder relative w-full flex items-center ">
    <div class=" w-full h-full min-h-[2.5rem] bg-gray-100 rounded-md animate-pulse px-2"></div>
</div>