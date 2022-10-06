<?php
$awesomecoder_app_icon =  get_post_meta(get_the_ID(), "awesomecoder_app_icon", true);
$awesomecoder_app_downloads =  get_post_meta(get_the_ID(), "awesomecoder_app_downloads", true);
$awesomecoder_app_stars =  get_post_meta(get_the_ID(), "awesomecoder_app_stars", true);
$awesomecoder_app_ratings =  get_post_meta(get_the_ID(), "awesomecoder_app_ratings", true);
$awesomecoder_app_devName =  get_post_meta(get_the_ID(), "awesomecoder_app_devName", true);
$awesomecoder_app_devLink =  get_post_meta(get_the_ID(), "awesomecoder_app_devLink", true);
$awesomecoder_app_compatible_with =  get_post_meta(get_the_ID(), "awesomecoder_app_compatible_with", true);
$awesomecoder_app_size =  get_post_meta(get_the_ID(), "awesomecoder_app_size", true);
$awesomecoder_app_last_version =  get_post_meta(get_the_ID(), "awesomecoder_app_last_version", true);
$awesomecoder_app_link =  get_post_meta(get_the_ID(), "awesomecoder_app_link", true);
$awesomecoder_app_price =  get_post_meta(get_the_ID(), "awesomecoder_app_price", true);
$categories = get_the_category();

?>

<div class="w-full relative awesomecoder">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full font-poppins m-0 text-sm text-left text-gray-500 dark:text-gray-400 border-none divide-none">
            <tbody>
                <tr class=" dark:bg-gray-800 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                    <th scope="row" class="flex items-center  md:px-6 md:py-4 px-3 py-2 border-none divide-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="m12.954 11.616 2.957-2.957L6.36 3.291c-.633-.342-1.226-.39-1.746-.016l8.34 8.341zm3.461 3.462 3.074-1.729c.6-.336.929-.812.929-1.34 0-.527-.329-1.004-.928-1.34l-2.783-1.563-3.133 3.132 2.841 2.84zM4.1 4.002c-.064.197-.1.417-.1.658v14.705c0 .381.084.709.236.97l8.097-8.098L4.1 4.002zm8.854 8.855L4.902 20.91c.154.059.32.09.495.09.312 0 .637-.092.968-.276l9.255-5.197-2.666-2.67z"></path>
                        </svg>
                        <span class="ml-2 text-sm font-semibold">Name</span>
                    </th>
                    <td class=" md:px-6 md:py-4 px-3 py-2 border-none divide-none">
                        <a class="text-sm font-semibold text-primary-400 hover:text-primary-500 transition-all duration-150" target="_blank" href="<?php echo $awesomecoder_app_link; ?>"><?php the_title(); ?></a>
                    </td>
                </tr>
                <tr class=" dark:bg-gray-800 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                    <th scope="row" class="flex items-center  md:px-6 md:py-4 px-3 py-2 border-none divide-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="ml-2 text-sm font-semibold">Price</span>
                    </th>
                    <td class=" md:px-6 md:py-4 px-3 py-2 border-none divide-none">
                        <h1 class="text-sm font-semibold"><?php echo $awesomecoder_app_price ?? "Free"; ?></h1>
                    </td>
                </tr>
                <tr class=" dark:bg-gray-800 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                    <th scope="row" class="flex items-center  md:px-6 md:py-4 px-3 py-2 border-none divide-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="ml-2 text-sm font-semibold">Updated</span>
                    </th>
                    <td class=" md:px-6 md:py-4 px-3 py-2 border-none divide-none">
                        <h1 class="text-sm font-semibold"><?php echo get_the_modified_date(get_option('date_format')); ?></h1>
                    </td>
                </tr>
                <tr class=" dark:bg-gray-800 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                    <th scope="row" class="flex items-center  md:px-6 md:py-4 px-3 py-2 border-none divide-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                        <span class="ml-2 text-sm font-semibold">Rating <?php echo $awesomecoder_app_stars ? "($awesomecoder_app_stars)" : "" ?></span>
                    </th>
                    <td class=" md:px-6 md:py-4 px-3 py-2 border-none divide-none">
                        <div class="relative flex items-center">
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
                                <div class="absolute bg-slate-900 top-0 left-0 bottom-0 right-0 mix-blend-overlay" style="width:<?php echo ($awesomecoder_app_ratings / 5 * 100); ?>% ;"></div>
                            </div>
                            <span class="text-sm font-semibold m-0"><?php echo $awesomecoder_app_ratings ? "($awesomecoder_app_ratings)" : ""; ?></span>
                        </div>
                    </td>
                </tr>

                <tr class=" dark:bg-gray-800 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                    <th scope="row" class="flex items-center  md:px-6 md:py-4 px-3 py-2 border-none divide-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                        </svg>
                        <span class="ml-2 text-sm font-semibold">Compatible with</span>
                    </th>
                    <td class=" md:px-6 md:py-4 px-3 py-2 border-none divide-none">
                        <h1 class="text-sm font-semibold"><?php echo $awesomecoder_app_compatible_with; ?></h1>
                    </td>
                </tr>
                <tr class=" dark:bg-gray-800 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                    <th scope="row" class="flex items-center  md:px-6 md:py-4 px-3 py-2 border-none divide-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        <span class="ml-2 text-sm font-semibold">Last version</span>
                    </th>
                    <td class=" md:px-6 md:py-4 px-3 py-2 border-none divide-none">
                        <h1 class="text-sm font-semibold"><?php echo $awesomecoder_app_last_version; ?></h1>
                    </td>
                </tr>
                <tr class=" dark:bg-gray-800 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                    <th scope="row" class="flex items-center  md:px-6 md:py-4 px-3 py-2 border-none divide-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="ml-2 text-sm font-semibold">Size</span>
                    </th>
                    <td class=" md:px-6 md:py-4 px-3 py-2 border-none divide-none">
                        <h1 class="text-sm font-semibold"><?php echo $awesomecoder_app_size; ?></h1>
                    </td>
                </tr>

                <?php if (!empty($categories)) : ?>
                    <tr class=" dark:bg-gray-800 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                        <th scope="row" class="flex items-center  md:px-6 md:py-4 px-3 py-2 border-none divide-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            <span class="ml-2 text-sm font-semibold">Category</span>
                        </th>
                        <td class=" md:px-6 md:py-4 px-3 py-2 border-none divide-none">
                            <a class="text-sm font-semibold text-primary-400 hover:text-primary-500 transition-all duration-150" target="_blank" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                        </td>
                    </tr>
                <?php endif; ?>

                <tr class=" dark:bg-gray-800 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                    <th scope="row" class="flex items-center  md:px-6 md:py-4 px-3 py-2 border-none divide-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="ml-2 text-sm font-semibold">Developer</span>
                    </th>
                    <td class=" md:px-6 md:py-4 px-3 py-2 border-none divide-none">
                        <a class="text-sm font-semibold text-primary-400 hover:text-primary-500 transition-all duration-150" target="_blank" href="<?php echo $awesomecoder_app_devLink; ?>"><?php echo $awesomecoder_app_devName; ?></a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>