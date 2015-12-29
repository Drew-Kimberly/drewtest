<?php
/*
 * Renders the content to display within the
 * 'Magic' tab on the user account page.
 *
 * Params:
 *      $wildcard - Should be the ID of the user
 */
function menu_magic_user_tab($wildcard) {
    //wildcard must be integer and Drupal's user_load(user_id) function msut load a user account
    if (is_numeric($wildcard) && ($account = user_load($wildcard))) {
        return array(
            '#type' => 'markup',
            '#markup' => t("%username is totally awesome.", array('%username' => $account->name)),
        );
    }
    else {
        return drupal_not_found();
    }
}