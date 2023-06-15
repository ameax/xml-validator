<?php

namespace Ameax\XmlValidator;

use DOMDocument;
use Exception;

class XmlValidator
{
    public array $result;

    public function validate(string $xmlContentOrPath, string $xsdPath, bool $isPath = true): XmlValidator
    {
        // Enable user error handling
        libxml_use_internal_errors(true);

        $xml = new DOMDocument();

        if ($isPath) {
            $xml->load($xmlContentOrPath);
        } else {
            $xml->loadXML($xmlContentOrPath);
        }
        if ($xml->schemaValidate($xsdPath)) {
            $this->result = ['valid' => true];
        } else {
            $this->result = ['valid' => false, 'errors' => $this->getErrorMessages()];
        }
        libxml_clear_errors();

        return $this;
    }

    public static function validateString(string $xmlContent, string $xsdPath): XmlValidator
    {
        $validator = new XmlValidator;

        return $validator->validate($xmlContent, $xsdPath, false);
    }

    public static function validateFile(string $xmlPath, string $xsdPath): XmlValidator
    {
        $validator = new XmlValidator;

        return $validator->validate($xmlPath, $xsdPath, true);
    }

    public function getErrors(): string
    {
        return $this->result['errors'] ?? '';
    }

    /**
     * @throws Exception
     */
    public function throwExceptionOnErrors(): void
    {
        if (! $this->result['valid']) {
            throw new ExceptionXmlNotValid($this->result['errors']);
        }
    }

    protected function getErrorMessages(): string
    {
        $errors = libxml_get_errors();
        $tr = '';
        foreach ($errors as $error) {
            $tr .= $this->getErrorMessage($error);
        }

        return $tr;
    }

    protected function getErrorMessage($error): string
    {
        $tr = '';
        switch ($error->level) {
            case LIBXML_ERR_WARNING:
                $tr .= 'Warning: ';
                break;
            case LIBXML_ERR_ERROR:
                $tr .= 'Error: ';
                break;
            case LIBXML_ERR_FATAL:
                $tr .= 'Fatal Error: ';
                break;
        }
        $tr .= $error->code.PHP_EOL;
        $tr .= trim($error->message);
        if ($error->file) {
            $tr .= ' '.$error->file;
        }
        $tr .= ' on line '.$error->line;
        $tr .= PHP_EOL.PHP_EOL;

        return $tr;
    }

    public function getResult(): array
    {
        return $this->result;
    }

    public function isValid(): bool
    {
        return $this->result['valid'] ?? false;
    }
}
