<!-- <div class="border border-slate-500/20 shadow rounded-md p-4 max-w-sm w-full mx-auto">
    <div class="animate-pulse flex space-x-4">
        <div class="rounded-full bg-slate-200 h-20 w-20"></div>
        <div class="flex-1 space-y-6 py-1">
            <div class="h-2 bg-slate-200 rounded "></div>
            <div class="space-y-3">
                <div class="grid grid-cols-3 gap-4">
                    <div class="h-2 bg-slate-200 rounded col-span-2"></div>
                    <div class="h-2 bg-slate-200 rounded col-span-1"></div>
                </div>
                <div class="h-2 bg-slate-200 rounded"></div>
            </div>
        </div>
    </div>
</div>

<div key={post.id} className="p-2 cursor-pointer relative bg-white rounded-md border border-slate-400/25 transform translate-y-0 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200 shadow-slate-200 ">
                            {post.title}
                            <div class="border border-slate-500/20 shadow rounded-md p-4 max-w-sm w-full mx-auto">
                                <div class="animate-pulse flex space-x-4">
                                    <div class="rounded-full bg-slate-200 h-20 w-20"></div>
                                    <div class="flex-1 space-y-6 py-1">
                                        <div class="h-2 bg-slate-200 rounded "></div>
                                        <div class="space-y-3">
                                            <div class="grid grid-cols-3 gap-4">
                                                <div class="h-2 bg-slate-200 rounded col-span-2"></div>
                                                <div class="h-2 bg-slate-200 rounded col-span-1"></div>
                                            </div>
                                            <div class="h-2 bg-slate-200 rounded"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
-->

<?php


$args = array(
    'post_type'   => 'post',
    'post_status' => 'published'
);
$posts = new WP_Query($args);

if ($posts->have_posts()) :
    while ($posts->have_posts()) : $posts->the_post();
        the_title();
    endwhile;
else :
    echo "Not data";
endif;
