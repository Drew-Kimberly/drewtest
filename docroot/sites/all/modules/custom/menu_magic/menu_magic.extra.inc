<?php
/*
 * Renders content using dynamic wildcard passed into url by user
 */
function menu_magic_extra($wildcard) {
    $content = array(
        '#type' => 'markup',
        '#markup' => '<p>'. t('The wildcard contains the value "%wildcard".', array('%wildcard' => $wildcard)). '</p>',
        //Notice variable substitution (secure coding) in the above t() function
    );

    return $content;
}