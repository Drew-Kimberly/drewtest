<?php

/*
 * @file
 * template.php file for ninesixtyrobots theme.
 *
 * Implement preprocess functions and alter hooks in this file.
 */

/*
 * Preprocess function for page.tpl.php.
 *
 * This gets called every time a section of the page is rendered. (without "_page")
 * We add "_page" to the function name to specify that the function is only called
 * when the page load hook is called (once per page).
 */
function ninesixtyrobots_preprocess_page(&$variables) {
    $slogans = array(
        t('Life is good.'),
        t("Even if you are on the right track, you will get run over if you just sit there."),
        t("My life has been filled with terrible misfortune."),
        t("The shortest distance between two points is under construction."),
        t("Most people would rather die than think; in fact, they do so."),
        t("The minute you settle for less than you deserve, you get even less than you settled for."),
        t("Age is of no importance unless you're a cheese."),
        t("If at first you don't succeed, then skydiving definitely isn't for you."),
    );

    //Select random slogan from the list of slogans
    $slogan = $slogans[array_rand($slogans)];
    $variables['site_slogan'] = $slogan; //Changes the site slogan


    //Add new variable to page.tpl
    if ($variables['logged_in']) {
        $variables['footer_message'] = t('Welcome @username, Lullabot loves you.', array('@username' => $variables['user']->name));
    }
    else {
        $variables['footer_message'] = t('Lullabot loves you.');
    }


    //If we're on the front page, we'll add an additional CSS file to make the background color pink
    if ($variables['is_front']) {
        drupal_add_css(path_to_theme() . '/css/front.css', array('group'=>CSS_THEME)); //group option makes the browser
                                                                                        //load in the file last
    }
}


/*
 * Preprocess function for node--article.tpl.php
 */
function ninesixtyrobots_preprocess_node(&$variables) {
    if ($variables['type'] == 'article') {
        $node = $variables['node'];
        //kpr($node);

        //Drupal date format functions
        $variables['submitted_day'] = format_date($node->created, 'custom', 'j');
        $variables['submitted_month'] = format_date($node->created, 'custom', 'M');
        $variables['submitted_year'] = format_date($node->created, 'custom', 'Y');
    }


    if ($variables['type'] == 'page') {
        $today = date('l');
        $variables['theme_hook_suggestions'][] = 'node__day'; //Add special dynamic day-of-week suggestion to theme_hook_suggestions
        $variables['day_of_the_week'] = $today; //Pass variable to the template
        //krumo($variables);
    }
}


/*
 * Implements theme_breadcrumb().
 */
function ninesixtyrobots_breadcrumb($variables) {
    $breadcrumb = $variables['breadcrumb'];

    if (!empty($breadcrumb)) {
        // Provide a navigational heading to give context for breadcrumb links to
        // screen-reader users. Make the heading invisible with .element-invisible.
        $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';

        $title = drupal_get_title();
        $output .= '<div class="breadcrumb">' . implode(' » ', $breadcrumb) . ' » ' . $title . '</div>';
        return $output;
    }
}


/*
 * Preprocess function for the theme function theme_username().
 */
function ninesixtyrobots_preprocess_username(&$variables) {
    $account = user_load($variables['account']->uid);
    if (isset($account->field_full_name[LANGUAGE_NONE][0]['safe_value'])) {
        $variables['name'] = $account->field_full_name[LANGUAGE_NONE][0]['safe_value'];
    }
}


/*
 * Implements theme_field().
 *
 * Altering the appearance of tags in our site.
 */
function ninesixtyrobots_field__field_tags($variables) {
    $output = '';

    $links = array();
    foreach ($variables['items'] as $delta => $item) { //$delta represents positional value (0, 1, 2, ...)
        $item['#options']['attributes'] += $variables['item_attributes_array'][$delta];
        $links[] = drupal_render($item); //outputs renderable array into html (an <a> in this case)
    }

    $output .= implode(', ', $links); //Converts array to single string, separated by ', '

    return $output;

}


/*
 * Implements hook_css_alter().
 *
 * We can alter the array of css files being added to the page.
 */
function ninesixtyrobots_css_alter(&$css) {
    //unset($css['modules/system/system.menus.css']);
}


/*
 * Implements hook_page_alter().
 *
 * Perform alterations before a page is rendered.
 */
function ninesixtyrobots_page_alter(&$page) {
    if (arg(0) == 'node' && is_numeric(arg(1))) { //Drupal's arg function refers to the url of the page
        $nid = arg(1);
        if (array_key_exists('field_image', $page['content']['system_main']['nodes'][$nid])) {
            $image = $page['content']['system_main']['nodes'][$nid]['field_image'];
            array_unshift($page['sidebar_first'], array('image'=>$image));
            unset($page['content']['system_main']['nodes'][$nid]['field_image']);
        }
    }
}


/*
 * Implements hook_form_alter().
 */
function ninesixtyrobots_form_alter(&$form, &$form_state, $form_id) {

    //Adds the search image to the search form.
    if ($form_id == 'search_block_form') {
        $form['actions']['submit']['#type'] = 'image_button';
        $form['actions']['submit']['#src'] = path_to_theme() . '/images/search.png';
        $form['actions']['submit']['#attributes']['class'][] = 'btn';
    }
}


/*
 * Implements hook_form_FORM_ID_alter().
 *
 * Form_ID = user_login
 *
 * Alters the user login form.
 */
function ninesixtyrobots_form_user_login_alter(&$form, &$form_state) {
    $form['name']['#title'] = t('Name');
}


/*
 * Implements hook_theme
 *
 * We're adding comment_form to the theme registry.
 * I.e. declaring this form "theme-able", so it can be overridden
 * by the theme layer.
 */
function ninesixtyrobots_theme($existing, $type, $theme, $path) {
    return array(
        'comment_form' => array( //Name of theme function we'd like to use to theme the form. (theme_comment_form)
            'render element' => 'form',
        ),
    );
}


/*
 * Implements theme_comment_form().
 *
 * We created this theme hook in the above function.
 */
function ninesixtyrobots_comment_form($variables) {
    $author = '<div class="grid_2 alpha">' . drupal_render($variables['form']['author']) . '</div>';
    $subject = '<div class="grid_3">' . drupal_render($variables['form']['subject']) . '</div>';
    hide($variables['form']['comment_body']['und'][0]['format']);
    $rest_of_form = drupal_render_children($variables['form']); //Renders everything in form besides subject/author
    return $author . $subject . $rest_of_form;
}