<?php

/**
 * helpers
 * helper functions to convert HTML to Markdown and Markdown to HTML
 * using League\HTMLToMarkdown and League/CommonMark
 *
 * Filename:        helpers.php
 * Location:        app/
 * Project:         my-laravel-app
 * Date Created:    22/12/2024
 *
 * Author:          Michael Reed
 *
 */

use League\CommonMark\GithubFlavoredMarkdownConverter;
use League\HTMLToMarkdown\HtmlConverter;
use League\CommonMark\CommonMarkConverter;


if (!function_exists('htmlToMarkdown')) {
    function htmlToMarkdown($html) {
        $converter = new HtmlConverter([
            'header_style' => 'atx', // This ensures # style headers
            'strip_tags' => false,
            'remove_nodes' => 'script style',
        ]);
        return $converter->convert($html);
    }
}

if (!function_exists('markdownToHtml')) {
//    function markdownToHtml($markdown) {
//        $converter = new CommonMarkConverter([
//            'html_input' => 'allow',
//            'allow_unsafe_links' => false,
//        ]);
//        return $converter->convertToHtml($markdown);
//    }
    function markdownToHtml($markdown) {
        $config = [
            'html_input' => 'allow', // this ensures our font colours are displayed in the submissions view
            'allow_unsafe_links' => false,
        ];

        $converter = new GithubFlavoredMarkdownConverter($config);
        return $converter->convert($markdown);
    }
}
