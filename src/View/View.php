<?php
namespace Art\View;

use Art\View\Renderers\HomePageRenderer;
use Art\View\Renderers\RendererInterface;

class View
{
    public function getRenderer(string $path) : RendererInterface
    {
        $path = 'showProducts';

        if ($path == 'showProducts') {
            return HomePageRenderer::createRenderer();
        }

    }
}