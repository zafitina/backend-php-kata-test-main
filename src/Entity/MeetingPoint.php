<?php

namespace App\Entity;

use App\Entity\Template;

class MeetingPoint extends Template
{
    public int $id;
    public string $url;
    public string $name;

    public function __construct(int $id, string $url, string $name)
    {
        $this->id = $id;
        $this->url = $url;
        $this->name = $name;
    }

    /**
     * Pemet d'ajouter le contenu de MeetingPoint dans le template
     *
     * @param  [type] $text Contenu du template à mettre à jour
     * @return [type]       [description]
     */
    public function computeText($text)
    {
        $text = str_replace('[lesson:meeting_point]', $this->name, $text);
        return $text;
    }
}
