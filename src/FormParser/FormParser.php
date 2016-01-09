<?php

namespace FormParser;

use DOMDocument;
use DOMXPath;

class FormParser
{
    /** @var \DOMXPath */
    protected $DOMXPath;

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
        $dom = new DOMDocument;
        try {
            $dom->loadHTMLFile($templateFile);
            $this->DOMXPath = new DOMXPath($dom);
        } catch (\Exception $e) {
            throw new \InvalidArgumentException("Could not load template file.");
        }
    }

    public function inputExists($input)
    {
        return (bool)$this->DOMXPath->query("//input[@name='$input']")->length;
    }

    public function getRequiredFields()
    {

        $requiredFields = $this->DOMXPath->query("//input[@required='']");
        return $this->getFieldNames($requiredFields);
    }

    public function getEmailFields()
    {

        $emailFields = $this->DOMXPath->query("//input[@type='email']");
        return $this->getFieldNames($emailFields);
    }

    public function getLabels()
    {
        $labels = $this->DOMXPath->query("//label");
        $array = [];
        /** @var \DOMElement $label */
        foreach ($labels as $label) {
            $for = $label->getAttribute('for');
            $name = $this->getTextContent($label);
            if ($for && $name) {
                $array[$for] = trim($name);
            }
        }
        return $array;
    }

    private function getFieldNames($DOMElements)
    {
        $fields = [];
        /** @var \DOMElement $node */
        foreach ($DOMElements as $node) {
            $fields[] = $node->getAttribute('name');
        }
        return $fields;
    }

    private function getTextContent($label)
    {
        foreach ($label->childNodes as $node) {
            if ($node->nodeType == XML_TEXT_NODE) {
                return $node->textContent;
            }
        }
        return false;
    }

}