<?php
/*
 * Renders content (in reverse) to be displayed when
 * the Magic link on the node context-menu is selected.
 *
 * params:
 *      $node - Node object passed in from %node
 */
function menu_magic_node_context($node) {
    $text = _menu_magicify($node->body['und'][0]['value']); //found using Devel module on node
    $output = array(
        '#type' => 'markup',
        '#markup' => $text,
    );
    return $output;
}

/*
 * Helper function.
 * Reverses the given body text
 */
function _menu_magicify($text) {
    return strrev($text);
}