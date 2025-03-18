<?php

/**
 * Hàm hỗ trợ cần thiết cho theme
 */

function debug_to_console($data, $context = 'Debug in Console')
{

    // Buffering to solve problems frameworks, like header() in this and not a solid return.
    ob_start();

    $output  = 'console.info(\'' . $context . ':\');';
    $output .= 'console.log(' . json_encode($data) . ');';
    $output  = sprintf('<script>%s</script>', $output);

    echo $output;
}
