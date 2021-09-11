<?php

namespace App\Entity;

use App\Entity\Template;

class Learner extends Template
{
    public int $id;
    public string $firstname;
    public string $lastname;
    public string $email;

    public function __construct(int $id, string $firstname, string $lastname, string $email)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
    }

    /**
     * Pemet d'ajouter le contenu de Leaner dans le template
     *
     * @param  [type] $text Contenu du template à mettre à jour
     * @return [type]       [description]
     */
    public function computeText($text)
    {
        (strpos($text, '[user:first_name]') !== false) and $text = str_replace('[user:first_name]', ucfirst(strtolower($this->firstname)), $text);
        return $text;
    }
}
