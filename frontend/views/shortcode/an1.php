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

?>

<div class="w-full relative px-2">
    <?php if ($apps->have_posts()) : ?>
        <div class="my-3 grid lg:grid-cols-3 md:grid-cols-2 gap-3">
            <?php while ($apps->have_posts()) : $apps->the_post(); ?>
                <?php $rating = get_post_meta(get_the_ID(), "awesomecoder_app_ratings", true) ? get_post_meta(get_the_ID(), "awesomecoder_app_ratings", true) : 0; ?>
                <a class="max-w-md w-full py-3 px-4 relative bg-white rounded shadow overflow-hidden grid space-y-1" href="<?php the_permalink(); ?>">
                    <img class="rounded-xl w-full" width="120" height="120" src="<?php echo get_post_meta(get_the_ID(), "awesomecoder_app_icon", true); ?>" alt="<?php echo the_title(); ?>">
                    <div>
                        <h1 class="text-lg font-semibold font-poppins my-1 text-slate-600 w-full max-w-sm whitespace-pre-line"><?php the_title(); ?></h1>
                    </div>
                    <div>
                        <h2 class="text-sm font-light font-poppins text-slate-500"><?php echo get_post_meta(get_the_ID(), "awesomecoder_app_devName", true);  ?></h2>
                    </div>
                    <div class="relative">
                        <div class="relative flex text-primary-300 w-fit overflow-hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <div class="absolute bg-slate-900 top-0 left-0 bottom-0 right-0 mix-blend-overlay" style="width:<?php echo ($rating / 5 * 100); ?>% ;"></div>
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