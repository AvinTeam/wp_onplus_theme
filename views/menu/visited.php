<?php
    (defined('ABSPATH')) || exit;
    global $title;

?>

<div class="wrap nosubsub">
    <h1 class="wp-heading-inline"><?php echo esc_html($title) ?></h1>


    <hr class="wp-header-end">

    <div id="col-container" class="wp-clearfix">

        <div id="col-left">
            <div class="col-wrap">
                <style>
                #arma_visited {
                    display: flex;
                    justify-content: center;
                    gap: 10px;
                }
                </style>


                <div class="form-wrap">
                    <form id="form-vizit" method="get" action="" class="validate">
                        <div id="arma_visited">
                            <div class="form-field w-100">
                                <label for="from_date">از تاریخ</label>
                                <input name="from_date" id="from_date" type="text" class="dir-ltr" value="" data-jdp=""
                                    data-jdp-max-date="today" data-jdp-only-date="">
                            </div>
                            <div class="form-field w-100">
                                <label for="to_date">تا تاربخ</label>
                                <input name="to_date" id="to_date" type="text" class="dir-ltr" value="" data-jdp=""
                                    data-jdp-max-date="today" data-jdp-only-date="">
                            </div>
                        </div>

                        <p class="submit">
                            <button type="submit" class="button button-primary">اعمال</button>
                        </p>
                    </form>
                </div>
            </div>
        </div><!-- /col-left -->

        <div id="col-right">
            <div class="col-wrap " id="arma_canvas" >
                <canvas id="viewsChart"></canvas>
            </div>
        </div><!-- /col-right -->

    </div><!-- /col-container -->

</div>

<!-- لودر تمام صفحه -->
<div class="overlay" id="overlay">
    <div class="loader"></div>
</div>