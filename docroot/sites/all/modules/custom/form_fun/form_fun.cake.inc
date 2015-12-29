<?php
/*
 * Implements page callback function for form_fun_menu.
 */
function form_fun_cake_page() {
    return drupal_get_form('form_fun_cake'); //Drupal Form API function -> form_fun_cake is unique ID of our form
}

/*
 * Builds Form API array
 * Referenced in Drupal_get_form in the page callback function
 *
 * Param:
 *      $form_state - Necessary argument for form building function, passed in by reference.
 */
function form_fun_cake($form, &$form_state) {

    $form['choice'] = array(
        '#type' => 'select', //Select for D7 is not super compatible for Edge browser
        '#title' => t('Cake or Pie?'),
        '#description' => t('Would you like cake or pie?'),
        '#options' => array(
            'cake' => t('Cake please'),
            'pie' => t('Pie I guess'),
        ),
        '#default_value' => 'cake',
        '#required' => TRUE,
    );

    $form['buttons']['submit'] = array( //Demonstrates the ability to nest the form elements within the array
        '#type' => 'submit',
        '#value' => t('Submit'),
    );

    $form['buttons']['equivolcate'] = array(
        '#type' => 'submit',
        '#value' => t('Equivocate'),
        '#submit' => array('form_fun_cake_equivocate'),//Allows us to call a submit function different than the default
        '#validate' => array(),//Overrides validation function... Set to a function different than the default
    );

    return $form;
}

/*
 * Implementation of validation function for the form_fun_cake form.
 *
 * Params (passed in by reference):
 *      $form -> $form array created in the form builder function form_fun_cake()
 *      $form_state -> State of the form... contains the data entered and submitted by the user.
 */
function form_fun_cake_validate(&$form, &$form_state) { //Naming convention for validation function
    //dsm($form_state);
    if ($form_state['values']['choice'] == 'cake') {
        form_set_error('choice', t('We are out of cake!'));
    }
}

/*
 * Implementation of the submit function for the form_fun_cake form.
 *
 * Params:
 *      $form - Form render array
 *      $form_state -> Form information including the submit data
 */
function form_fun_cake_submit(&$form, &$form_state) {
    //dsm($form_state['values']);
    $form_state['redirect'] = ''; //Redirects to the home page
}

/*
 * Implementation of custom submit function called by the
 * Equivocate button.
 */
function form_fun_cake_equivocate(&$form, &$form_state) {
    drupal_set_message(t('Make up your mind.'), 'warning');
}
