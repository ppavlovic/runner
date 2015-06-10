<?php

namespace G4\Runner;

use G4\Constants\Format;
use G4\Runner\Presenter\DataTransfer;
use G4\Runner\Presenter\Formatter;
use G4\Runner\Presenter\View;
use G4\Runner\Presenter\Renderer;
use G4\Runner\Presenter\ContentType;

class Presenter
{

    /**
     * @var DataTransfer
     */
    private $dataTransfer;

    /**
     * @var ContentType
     */
    private $contentType;


    public function __construct(DataTransfer $dataTransfer)
    {
        $this->dataTransfer = $dataTransfer;
        $this->contentType  = new ContentType($this->dataTransfer);
    }

    public function render()
    {
        (new Renderer($this->getFormattedBody(), $this->contentType, $this->dataTransfer))->render();
    }

    /**
     * @return string
     */
    private function getFormattedBody()
    {
        return (new View($this->getFormattedData(), $this->contentType, $this->dataTransfer))->renderBody();
    }

    /**
     * @return array
     */
    private function getFormattedData()
    {
        return (new Formatter($this->dataTransfer))->format();
    }
}