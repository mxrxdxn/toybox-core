<?php

namespace Toybox\Core\Docs;

use DomainException;
use Highlight\Highlighter;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Util\Xml;
use Throwable;

class HighlightedCodeRenderer implements NodeRendererInterface
{
    public function __construct(private readonly Highlighter $highlighter)
    {
    }

    public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
    {
        FencedCode::assertInstanceOf($node);

        $attributes = $node->data->getData('attributes');
        $language   = $node->getInfoWords()[0] ?? '';
        $code       = Xml::escape($node->getLiteral());

        if ($language !== '') {
            $language = preg_replace('/^language-/', '', $language);
            $attributes->append('class', 'hljs');
            $attributes->append('class', 'language-' . $language);

            try {
                $code = $this->highlighter->highlight($language, $node->getLiteral())->value;
            } catch (DomainException) {
                // Preserve unknown languages as escaped, unhighlighted code.
            } catch (Throwable) {
                // A malformed language definition should not prevent docs rendering.
            }
        }

        return new HtmlElement(
            'pre',
            [],
            new HtmlElement('code', $attributes->export(), $code)
        );
    }
}
