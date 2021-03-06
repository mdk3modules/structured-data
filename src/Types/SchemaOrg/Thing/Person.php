<?php namespace Taskforcedev\StructuredData\Types\SchemaOrg\Thing;

use Taskforcedev\StructuredData\Types\SchemaTypeInterface;
use Taskforcedev\StructuredData\Types\SchemaOrg\Thing;

class Person extends Thing implements SchemaTypeInterface
{
    public $givenName;
    public $familyName;
    public $email;

    public function setGivenName($givenName) { $this->givenName = $givenName; }
    public function setForename($forename) { $this->givenName = $forename; }
    public function setFamilyName($familyName) { $this->familyName = $familyName; }
    public function setSurname($surname) { $this->familyName = $surname; }
    public function setEmail($email) { $this->email = $email; }

    public function getJsonLd($context = true, $json_object = true)
    {
        $jsonLd = [
            '@type' => 'Person',
        ];

        if ($context === true) { $jsonLd['@context'] = 'http://schema.org'; }

        $requiredFields = ['givenName', 'familyName'];

        foreach ($requiredFields as $field) {
            if ($this->$field !== '') {
                $jsonLd[$field] = $this->$field;
            }
        }

        $optionalFields = ['email'];

        foreach ($optionalFields as $field) {
            if ($this->$field !== '') {
                $jsonLd[$field] = $this->$field;
            }
        }

        if ($json_object === true) {
            $object = (object)$jsonLd;

            return json_encode($object);
        }

        return $jsonLd;
    }
}
