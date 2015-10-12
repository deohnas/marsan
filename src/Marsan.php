<?php
namespace Marsan;

class Marsan
{
    protected $whitelist = [
        'basic_tags' => '/^(<\/?(b|blockquote|code|del|dd|dl|dt|em|h1|h2|h3|i|kbd|li|ol(?: start="\d+")?|p|pre|s|sup|sub|strong|strike|ul)>|<(br|hr)\s?\/?>)$/i',
        'links' => '/^(<a\shref="((https?|ftp):\/\/|\/)[-A-Za-z0-9+&@#\/%?=~_|!:,.;\(\)*[\]$]+"(\stitle="[^"<>]+")?\s?>|<\/a>)$/i',
        'img' => '/^(<img\ssrc="(https?:\/\/|\/)[-A-Za-z0-9+&@#\/%?=~_|!:,.;\(\)*[\]$]+"(\swidth="\d{1,3}")?(\sheight="\d{1,3}")?(\salt="[^"<>]*")?(\stitle="[^"<>]*")?\s?\/?>)$/',
    ];

    public function sanitizeHtml($html)
    {
        return preg_replace_callback('/<[^>]*>?/i', [$this, 'sanitizeTag'], $html);
    }

    protected function sanitizeTag($tag)
    {
        $basic_tags = preg_match($this->whitelist['basic_tags'], $tag[0]);
        $links = preg_match($this->whitelist['links'], $tag[0]);
        $img = preg_match($this->whitelist['img'], $tag[0]);

        if ($basic_tags || $links || $img) {
            return $tag[0];
        }

        return '';
    }
}