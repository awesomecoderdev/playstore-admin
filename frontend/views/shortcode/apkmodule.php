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
                <a class="max-w-md w-full relative bg-white p-2 hover:bg-slate-100/50 flex rounded overflow-hidden" href="<?php the_permalink(); ?>">
                    <img class="rounded-lg h-20 w-20" width="120" height="120" src="<?php echo get_post_meta(get_the_ID(), "awesomecoder_app_icon", true); ?>" alt="<?php echo the_title(); ?>">
                    <div class="relative ml-2 grid space-y-1">
                        <h1 class="text-sm whitespace-pre-line font-light font-poppins text-slate-500 w-full max-w-sm truncate mr-2"><?php the_title(); ?></h1>
                        <h2 class="text-xs font-light font-poppins text-slate-500"><?php echo get_the_modified_date($date_format); ?></h2>
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