<?php
namespace Marsan;

class Marsan
{
    protected $whitelist = [
        'basic_tags' => '/^(<\/?(b|blockquote|code|del|dd|dl|dt|em|h1|h2|h3|i|kbd|li|ol(?: start="\d+")?|p|pre|s|sup|sub|strong|strike|ul)>|<(br|hr)\s?\/?>)$/i',
    ];

    public function sanitizeHtml($html)
    {
        return preg_replace_callback('/<[^>]*>?/i', [$this, 'sanitizeTag'], $html);
    }

    protected function sanitizeTag($tag)
    {
        if (preg_match($this->whitelist['basic_tags'], $tag[0])) {
            return $tag[0];
        }
        
        return '';
    }
}