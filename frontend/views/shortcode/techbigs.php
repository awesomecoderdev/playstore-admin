<?php
$args = [
    'post_type'         => "post", //all pages
    'posts_per_page'    => intval($awesomecoder["posts_per_page"]) ?? 12,
    'order'             => 'ASC',
    'orderby'        => 'name',
    'paged'        => max(1, get_query_var('paged')),
    'meta_query'    => [
        [
            "key" => 'awesomecoder_app_icon',
            'compare' => 'EXISTS',
        ],
    ]
];

if (isset($awesomecoder["category"]) && $awesomecoder["category"] != null) {
    $args["tax_query"] = [
        'relation' => 'OR',
        [
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => strtolower($awesomecoder["category"]),
        ],
    ];
}

$apps = new WP_Query($args);
$date_format = get_option('date_format');

?>

<div class="w-full relative px-2">
    <?php if ($apps->have_posts()) : ?>
        <div class="my-3 grid lg:grid-cols-3 md:grid-cols-2 gap-3">
            <?php while ($apps->have_posts()) : $apps->the_post(); ?>
                <a class="max-w-md w-full relative bg-white flex rounded shadow overflow-hidden min-h-[12rem]" href="<?php the_permalink(); ?>">
                    <div class="absolute top-0 bottom-0 right-0 left-0 bg-contain bg-center hover:scale-105 transform duration-150 h-full w-full" style="background-image: url(<?php echo get_post_meta(get_the_ID(), "awesomecoder_app_icon", true); ?>);" title="<?php echo the_title(); ?>">
                    </div>
                    <div class="absolute top-0 bottom-0 right-0 left-0 pointer-events-none hover:scale-105 transform duration-150 bg-black/70 h-full w-full">
                    </div>
                    <div class="relative p-4 pointer-events-none">
                        <h1 class="text-lg font-semibold font-poppins text-white  w-full max-w-sm truncate mr-2"><?php the_title(); ?></h1>
                        <h2 class="text-sm font-light font-poppins text-slate-50"><?php echo get_post_meta(get_the_ID(), "awesomecoder_app_devName", true);  ?></h2>
                        <div class="grid">
                            <h2 class="text-xs font-light font-poppins text-slate-50"><?php echo get_the_modified_date($date_format); ?></h2>
                            <div class="flex space-x-1 min-w-[10rem] absolute bottom-2">
                                <span class=" rounded-full bg-primary-400 px-1.5 py-0.5 text-xs font-light font-poppins text-white">APK</span>
                                <?php if (get_post_meta(get_the_ID(), "awesomecoder_app_downloads", true)) : ?>
                                    <span class="rounded-full flex items-center  bg-primary-400 px-1.5 py-0.5 text-xs font-light font-poppins text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 13l-5 5m0 0l-5-5m5 5V6" />
                                        </svg>
                                        <?php echo get_post_meta(get_the_ID(), "awesomecoder_app_downloads", true);  ?>
                                    </span>
                                <?php endif; ?>
                                <?php if (get_post_meta(get_the_ID(), "awesomecoder_app_ratings", true)) : ?>
                                    <span class="rounded-full flex items-center  bg-primary-400 px-1.5 pr-2 py-0.5 text-xs font-light font-poppins text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <?php echo get_post_meta(get_the_ID(), "awesomecoder_app_ratings", true);  ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endwhile; ?>
        </div>
        <?php if ($awesomecoder["paginate"] == true && !is_home()) : ?>
            <div class="w-full flex justify-center items-center relative awesomecoder-paginate mx-auto">
                <div class="max-w-lg">
                    <?php
                    $big = 999999999; // need an unlikely integer
                    echo paginate_links(array(
                        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'format' => '?paged=%#%',
                        'current' => max(1, get_query_var('paged')),
                        'total' => $apps->max_num_pages
                    ));
                    ?>
                </div>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <span class="cursor-pointer bg-white hover:bg-gray-100 text-slate-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1">
            <?php _e("No apps available.", "awesomecoder"); ?>
        </span>
    <?php endif; ?>
</div>