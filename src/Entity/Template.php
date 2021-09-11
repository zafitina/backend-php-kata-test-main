<?php

namespace App\Entity;

class Template
{
    public int $id;
    public string $subject;
    public string $content;

    public function __construct(int $id, string $subject, string $content)
    {
        $this->id = $id;
        $this->subject = $subject;
        $this->content = $content;
    }

    /**
     * Permet d'y ajouter le contenu de la classe fille dans le template manager
     *
     * @param  [type] $text [description]
     * @return [type]       [description]
     */
    public function computeText($text = null)
    {
    }
}
