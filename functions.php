<?php

function type_validation(string $type): bool
{
    return (array_filter(TYPES, function ($prebuiltType) use ($type) {
            return $prebuiltType['type'] == $type;
        }) != null);
}

function get_link(string $href, string $content): string
{
    $document = new DOMDocument();
    $element = $document->createElement('a');
    $element->textContent = $content;
    $element->setAttribute('href', $href);
    $document->append($element);
    return $document->saveHTML();
}

function href_format(string $type, string $href): string
{
    return match ($type) {
        TYPE_PHONE['type'] => TYPE_PHONE['prefix'] . preg_replace('/[^0-9]/', '', $href),
        TYPE_DEFAULT['type'] => TYPE_DEFAULT['prefix'] . $href,
        TYPE_EMAIL['type'] => TYPE_EMAIL['prefix'] . $href,
        default => $href
    };
}

/**
 * @throws ParamNotFoundException
 * @throws InvalidParamException
 */
function link_to(array $params): string
{
    if (!isset($params['type'])) {
        throw new ParamNotFoundException('type');
    }

    if (!type_validation($params['type'])) {
        throw new InvalidParamException('type', $params['type']);
    }

    if (!isset($params['content'])) {
        throw new ParamNotFoundException('content');
    }

    switch ($params['type']) {
        case TYPE_DEFAULT['type']:
            if (!isset($params['href'])) {
                throw new ParamNotFoundException('href');
            }
            $href = href_format($params['type'], $params['href']);
            return get_link($href, $params['content']);
        case TYPE_PHONE['type']:
        case TYPE_EMAIL['type']:
        default:
            $href = href_format($params['type'], $params['content']);
            return get_link($href, $params['content']);
    }
}