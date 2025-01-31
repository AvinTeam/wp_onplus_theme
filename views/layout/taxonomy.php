

<div class="container-fluid  py-4">
    <!-- New Section with Background -->
    <div class="container-fluid position-relative"
        style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0,0,0,0.7) 70%),
               linear-gradient(to right, rgba(0,0,0,0) 40%, rgba(0,0,0,0.7) 50%),
               url('<?php echo $image_url_baner?>');
               background-size: cover;
               background-position: center;
               height: 500px;
               padding: 50px 0;">
        <div class="row h-100 align-items-center text-white">
            <div class="col-md-3 text-center">
                <img src="<?php echo $image_url?>" class="img-fluid" alt="Thumbnail">
            </div>
            <div class="col-md-9">
                <div class="d-flex align-items-center justify-content-between">
                    <h3><?php echo $term_name?></h3>
                    <i class="bi bi-heart text-danger fs-4"></i>
                </div>
                <p><?php echo $term_description?></p>
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
    <div class="view-all d-flex justify-content-between align-items-center px-3  my-5">
        <h5>قسمت ها</h5>
    </div>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4 mx-0" id="video-cards">
        <!-- Card 1 -->


        <?php foreach ($all_episode as $episode) : ?>

        <div class="col">
            <div class="card position-relative">
                <img src="<?=$episode['image']?>" class="card-img-top" alt="<?=$episode['title']?>">
                <div class="position-absolute top-0 start-0 p-2">
                    <i class="bi bi-play-circle text-danger"></i>
                    <span class="text-white bg-danger px-1">رایگان</span>
                </div>
            </div>
            <div class="card-body d-flex justify-content-between">
                <span class="text-secondary">00:45:23</span>
                <h6 class="text-right"><?=$episode['title']?></h6>
            </div>
            <p class="card-text text-first text-right"><?=$episode['title']?></p>
        </div>
        <?php endforeach ; ?>

    </div>

    <!-- Pagination -->
    <nav class="mt-4">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled"><a class="page-link" href="#" onclick="changePage(-1)">قبلی</a></li>
            <li class="page-item active"><a class="page-link" href="#" onclick="changePage(1)">1</a></li>
            <li class="page-item"><a class="page-link" href="#" onclick="changePage(2)">2</a></li>
            <li class="page-item"><a class="page-link" href="#" onclick="changePage(3)">3</a></li>
            <li class="page-item"><a class="page-link" href="#" onclick="changePage(1)">بعدی</a></li>
        </ul>
    </nav>
</div>

<script>
    const cardsPerPage = 15;
    let currentPage = 1;

    function changePage(page) {
        const cards = document.querySelectorAll('#video-cards .col');
        const totalPages = Math.ceil(cards.length / cardsPerPage);
        if (page < 1 || page > totalPages) return;

        currentPage = page;
        cards.forEach((card, index) => {
            card.style.display = (index >= (page - 1) * cardsPerPage && index < page * cardsPerPage) ? 'block' : 'none';
        });
    }

    document.addEventListener('DOMContentLoaded', () => changePage(1));
</script>

<div class="container-fluid my-5 p-0">
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



