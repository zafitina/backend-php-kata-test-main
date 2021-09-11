<?php

namespace App\Entity;

use App\Entity\Template;

class Instructor extends Template
{
    public int $id;
    public string $firstname;
    public string $lastname;

    public function __construct(int $id, string $firstname, string $lastname)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    /**
     * Pemet d'ajouter le contenu de Instructor dans le template
     *
     * @param  [type] $text Contenu du template à mettre à jour
     * @return [type]       [description]
     */
    public function computeText($text)
    {
        $text = str_replace('[instructor_link]', 'instructors/' . $data['instructor']->id .'-'.urlencode($data['instructor']->firstname), $text);
        return $text;
    }
}
