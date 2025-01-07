<?php
(defined('ABSPATH')) || exit;

function mat_prefix_edit_meta_fields()
{
    $format_art_question = unserialize(get_term_meta(absint($_GET[ 'tag_ID' ]), 'format_art_question', true));
    $format_art_question = (is_array($format_art_question)) ? $format_art_question : [  ];

    ?>

<tr class="form-field form-required term-name-wrap">
    <th colspan="2" scope="row">سوال های داوری</th>
    <input type="hidden" name="id_taxonomy" id="id_taxonomy" value="<?=absint($_GET[ 'tag_ID' ])?>" />
</tr>
<?php foreach ($format_art_question as $question): ?>

<tr class="form-field form-required term-name-wrap">
    <th scope="row">
        <button class="button button-danger mat_btn_remove" type="button" id="mat_btn_remove">حذف</button>
    </th>
    <td>

        <table class="form-table" role="presentation">
            <tbody>
                <tr class="form-field term-slug-wrap">
                    <th scope="row"><label for="slug">سوال</label></th>
                    <td><input type="text" name="format_art_question[question][]" class="form-control"
                            value="<?=$question[ 'question' ]?>" />
                    </td>
                </tr>
                <tr class="form-field term-slug-wrap">
                    <th scope="row"><label for="slug">حداکثر امتیاز</label></th>
                    <td><input type="number" name="format_art_question[point][]" class="form-control"
                            value="<?=$question[ 'point' ]?>" />
                    </td>
                </tr>
            </tbody>
        </table>

    </td>
</tr>
<?php endforeach;?>



<tr id="parent_mat_btn_add" class="form-field form-required term-name-wrap">
    <td colspan="2" scope="row"><button class="button button-success" type="button" id="mat_btn_add">اضافه کردن
            سوال</button>
    </td>

</tr>


<?php
}

add_action("format_art_edit_form_fields", 'mat_prefix_edit_meta_fields');

add_action('init', function () {
    if (isset($_POST[ 'format_art_question' ])) {

        $format_art_question_post = [  ];

        foreach ($_POST[ 'format_art_question' ][ 'question' ] as $key => $value) {

            if (empty($value)) {continue;}

            $format_art_question_post[  ] = [
                'question' => sanitize_text_field($_POST[ 'format_art_question' ][ 'question' ][ $key ]),
                'point' => absint($_POST[ 'format_art_question' ][ 'point' ][ $key ]),
             ];

        }

        $mat_option = mat_start_working();

        if ($mat_option[ 'file_referee' ]) {

            $format_art_question = unserialize(get_term_meta(absint($_POST[ 'tag_ID' ]), 'format_art_question', true));
            $format_art_question = (is_array($format_art_question)) ? $format_art_question : [  ];

            if (!empty($format_art_question)) {

                $query_args = [
                    'post_type' => 'matart',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'fields' => 'ids',
                    'tax_query' => [
                        [
                            'taxonomy' => 'format_art',
                            'field' => 'term_id',
                            'terms' => absint($_POST[ 'tag_ID' ]),
                         ],
                        'meta_query' => [
                            [
                                'key' => '_mat_total_points',
                                'value' => 0,
                                'compare' => '>',
                                'type' => 'NUMERIC',
                             ],
                         ],
                     ],
                 ];

                $query = new WP_Query($query_args);

                $post_count = $query->found_posts;

                if ($post_count) {

                    $difference1 = array_diff($format_art_question[ 'question' ], $format_art_question_post[ 'question' ]);
                    $difference2 = array_diff($format_art_question_post[ 'question' ], $format_art_question[ 'question' ]);

                    if (!empty($difference1) || !empty($difference2)) {

                        while ($query->have_posts()) {
                            $query->the_post();
                            update_post_meta(get_the_ID(), '_mat_total_points', 0);
                            update_post_meta(get_the_ID(), '_mat_referee_id', 0);
                            update_post_meta(get_the_ID(), '_mat_form_points', '');
                        }
                    }
                }
                wp_reset_postdata();
            }
        }

        update_term_meta(absint($_POST[ 'tag_ID' ]), 'format_art_question', serialize($format_art_question_post));

    }
});