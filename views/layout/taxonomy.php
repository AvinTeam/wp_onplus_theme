

<div class="container-fluid">
    <!-- New Section with Background -->
    <div class="container-fluid position-relative w-100 m-0 p-0"
        style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0,0,0,0.7) 70%),
               linear-gradient(to right, rgba(0,0,0,0) 40%, rgba(0,0,0,0.7) 50%),
               url('<?php echo $image_url_banner ?>');
               background-size: cover;
               background-position: center;
               height: 500px;
               padding: 50px 0;">
        <div class="row h-100 align-items-center justify-content-start text-white">
            <div class="col-md-3 text-end">
                <img src="<?php echo $image_url ?>" class="img-fluid" alt="Thumbnail">
            </div>
            <div class="col-md-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h3><?php echo $term_name ?></h3>
                    <i class="bi bi-heart text-danger fs-4"></i>
                </div>
                <p><?php echo $term_description ?></p>
                <div class="d-flex align-items-center">
                    <i class="bi bi-hand-thumbs-up-fill text-success me-2"></i>
                    <span>123 پسند</span>
                </div>
                <div class="mt-2">
                    <i class="bi bi-hand-thumbs-up me-2 fs-4 text-primary"></i>
                    <i class="bi bi-hand-thumbs-down fs-4 text-danger"></i>
                </div>
            </div>
        </div>
    </div>
</div>




    <!-- Card Row with Pagination -->
    <div class="view-all d-flex justify-content-between align-items-center px-3 my-2">
        <h5>قسمت ها</h5>
    </div>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4 mx-0" id="video-cards">
        <!-- Card 1 -->


        <?php foreach ($all_episode as $episode): ?>

        <div class="col on_category">
            <div class="card position-relative">
                <a href="<?php echo $episode[ 'permalink' ] ?>"><img src="<?php echo $episode[ 'image' ] ?>" class="card-img-top" alt="<?php echo $episode[ 'title' ] ?>"></a>
  
            </div>
            <div class="card-body d-flex justify-content-between">
                <span class="text-secondary arma_duration"><?php echo $episode[ 'duration' ]?></span>
                <h6 class="text-right arma_data"><?php echo $term_name ?> -<?php echo $episode[ 'data' ] ?></h6>
            </div>
            <a class="nav-link" href="<?php echo $episode[ 'permalink' ] ?>"><p class="card-text text-first text-right"><?php echo $episode[ 'title' ] ?></p></a>
        </div>
        <?php endforeach; ?>

    </div>

    <!-- Pagination -->






<?php
if ($query->max_num_pages > 1): ?>


<nav class="mt-4 mb-5">
<ul class="pagination justify-content-center">

<?php

    $big              = 999999999; // need an unlikely integer
    $translated       = '///';
    $pagination_links = paginate_links([
        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'total'     => $query->max_num_pages,
        'format'    => '?paged=%#%',
        'current'   => $paged,
        'prev_text' => 'قبلی',
        'next_text' => 'بعدی',
        'type'      => 'array',

     ]);

    if ($pagination_links):
        foreach ($pagination_links as $link):
            // بررسی آیا این لینک صفحه فعلی است یا نه
            if (strpos($link, 'current') !== false):
                echo '<li class="page-item active">' . str_replace('page-numbers', 'page-link', $link) . '</li>';
            else:
                echo '<li class="page-item">' . str_replace('page-numbers', 'page-link', $link) . '</li>';
            endif;
        endforeach;
    endif;
?>

</ul>
<?php endif; ?>

<div class="container-fluid my-5 p-0 d-none">
    <!-- Background Section -->
    <div class="row justify-content-center align-items-center"
         style="background: linear-gradient(to left, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.5)), url('images/your-image.jpg');
                background-size: cover; background-position: center;
                filter: grayscale(100%); padding: 50px 0;">

        <div class="col-md-8 text-first text-white">
            <!-- Main Title -->
            <h2 class="mb-3" style="font-size: 18px;">عوامل برنامه</h2>
            <div class="row justify-content-center align-items-center">
                <!-- Profile Picture -->
                <div class="col-md-3 text-first">
                    <img src="images/1729518377-1725093800-avatar.jpg" class="img-fluid rounded-circle" alt="Profile Picture"
                         style="width: 56px; height: 56px;">
                </div>
                <div class="col-md-9">
                    <!-- Left-aligned Titles -->
                    <div class="ms-md-4">
                        <h4 class="text-light" style="font-size: 18px;">عنوان اصلی کنار عکس پروفایل</h4>
                        <h5 class="text-light" style="font-size: 16px;">تیتر کوچکتر زیر عنوان اصلی</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>