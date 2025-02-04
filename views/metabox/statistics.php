<?php (defined('ABSPATH')) || exit; ?>

<div id="misc-publishing-actions">
    <div class="misc-pub-section dashicons-before dashicons-admin-post">
        تعداد ذخیره شده: <span><b><?php echo number_format($bookmark_count) ?></b></span>
    </div>

    <div class="misc-pub-section dashicons-before dashicons-visibility">
        تعداد بازدید کل: <span><b><?php echo number_format($all_visited) ?></b></span>
    </div>
    <div class="misc-pub-section dashicons-before dashicons-visibility">
        تعداد بازدید امروز: <span><b><?php echo number_format($today_visited) ?></b></span>
    </div>

</div>