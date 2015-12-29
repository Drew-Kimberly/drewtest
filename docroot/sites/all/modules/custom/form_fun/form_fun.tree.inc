<?php
/*
 *
 */
function form_fun_tree($form, &$form_state) {

    $form['#tree'] = TRUE; //Tells Drupal we're going to have a nested form structure

    //Define field for user's home address
    $form['home'] = array(
        '#type' => 'fieldset',
        '#title' => t('Home address'),
    );
    $form['home']['street'] = array(
        '#type' => 'textfield',
        '#title' => t('Street Address'),
    );
    $form['home']['city'] = array(
        '#type' => 'textfield',
        '#title' => t('City'),
    );

    //Define field for user's work address
    $form['work'] = array(
        '#type' => 'fieldset',
        '#title' => t('Work address'),
    );
    $form['work']['street'] = array(
        '#type' => 'textfield',
        '#title' => t('Street Address'),
    );
    $form['work']['city'] = array(
        '#type' => 'textfield',
        '#title' => t('City'),
    );

    //Define work address
    $form['submit'] = array(
        '#type' => 'submit',
        '#value' => t('Submit'), //Note that display text is '#value' for submit instead of '#title'
    );

    return $form;
}

/*
 * Implement the default on submit function for the
 * form_fun_tree form.
 */
function form_fun_tree_submit(&$form, &$form_state) {
    dsm($form_state);
}
