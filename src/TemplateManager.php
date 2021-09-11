<?php
namespace App;

use App\Context\ApplicationContext;
use App\Entity\Instructor;
use App\Entity\Learner;
use App\Entity\Lesson;
use App\Entity\Template;

class TemplateManager
{
    public function getTemplateComputed(Template $tpl, array $data)
    {
        if (!$tpl) {
            throw new \RuntimeException('no tpl given');
        }

        $replaced = clone($tpl);
        $replaced->subject = $this->computeText($replaced->subject, $data);
        $replaced->content = $this->computeText($replaced->content, $data);

        return $replaced;
    }

    private function computeText($text, array $data)
    {
        $APPLICATION_CONTEXT = ApplicationContext::getInstance();

        /**
         * LESSON
         */
        $lesson = (isset($data['lesson']) and $data['lesson'] instanceof Lesson) ? $data['lesson'] : null;

        if ($lesson) {
            $text = $lesson->computeText($text);
        }

        /**
         * INSCTRUCTOR
         */
        if (isset($data['instructor'])  and ($data['instructor']  instanceof Instructor)) {
            $instructor = $data['instructor'] ? $data['instructor'] : null;
            if ($instructor) {
                $text = $instructor->computeText($text);
            } else {
                $text = str_replace('[instructor_link]', '', $text);
            }
        }

        /*
         * USER
         */
        $_user  = (isset($data['user'])  and ($data['user']  instanceof Learner))  ? $data['user']  : $APPLICATION_CONTEXT->getCurrentUser();
        if ($_user) {
            $text = $_user->computeText($text);
        }

        return $text;
    }
}
