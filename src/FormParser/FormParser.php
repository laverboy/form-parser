<?php

namespace FormParser;

class FormParser
{
    /** @var \DOMXPath */
    protected $domxpath;

    /**
     * FormParser constructor.
     *
     * @param null $templateFile
     */
    public function __construct($templateFile = null)
    {
        if ($templateFile) {
            $this->setTemplate($templateFile);
        }
    }

    public function setTemplate($templateFile)
    {
        $dom = new \DOMDocument;
        try {
            $dom->loadHTMLFile($templateFile);
            $this->domxpath = new \DOMXPath($dom);
        } catch(\Exception $e){
            throw new \InvalidArgumentException("Could not load template file");
        }

    }

    public function inputExists($input)
    {
        return (bool) $this->domxpath->query( "//input[@name='$input']" )->length;
    }

}