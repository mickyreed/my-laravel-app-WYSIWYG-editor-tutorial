<?php

/**
 * helpers
 * A helper file with functions to convert HTML to Markdown and Markdown to HTML
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

namespace app;

use League\CommonMark\CommonMarkConverter;
use League\HTMLToMarkdown\HtmlConverter;


class ContentConverter
{
    /**
     * Convert HTML to Markdown
     *
     * @param string $html HTML content to convert
     * @return string Markdown content
     */
    public static function htmlToMarkdown($html)
    {
        $converter = new HtmlConverter([
            'strip_tags' => false,
            'remove_nodes' => 'script style',
        ]);

        return $converter->convert($html);
    }

    /**
     * Convert Markdown to HTML
     *
     * @param string $markdown Markdown content to convert
     * @return string HTML content
     */
    public static function markdownToHtml($markdown)
    {
        $converter = new CommonMarkConverter([
            'html_input' => 'allow',
            'allow_unsafe_links' => false,
        ]);

        return $converter->convertToHtml($markdown);
    }
}
