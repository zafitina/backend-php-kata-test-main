<?php

namespace App\Entity;

use App\Repository\InstructorRepository;
use App\Repository\LessonRepository;
use App\Repository\MeetingPointRepository;

use App\Entity\Template;

class Lesson extends Template
{
    public int $id;
    public int $meetingPointId;
    public int $instructorId;
    public \DateTime $start_time;
    public \DateTime $end_time;

    public function __construct(int $id, int $meetingPointId, int $instructorId, \DateTime $start_time, \DateTime  $end_time)
    {
        $this->id = $id;
        $this->meetingPointId = $meetingPointId;
        $this->instructorId = $instructorId;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
    }

    public static function renderHtml(Lesson $lesson): string
    {
        return '<p>' . $lesson->id . '</p>';
    }

    public static function renderText(Lesson $lesson): string
    {
        return (string) $lesson->id;
    }

    /**
     * Pemet d'ajouter le contenu de Lesson dans le template
     *
     * @param  [type] $text Contenu du template à mettre à jour
     * @return [type]       [description]
     */
    public function computeText()
    {
        $_lessonFromRepository = LessonRepository::getInstance()->getById($this->id);
        $usefulObject = MeetingPointRepository::getInstance()->getById($this->meetingPointId);
        $instructorOfLesson = InstructorRepository::getInstance()->getById($this->instructorId);

        if (strpos($text, '[lesson:instructor_link]') !== false) {
            $text = str_replace('[instructor_link]', 'instructors/' . $instructorOfLesson->id .'-'.urlencode($instructorOfLesson->firstname), $text);
        }

        $containsSummaryHtml = strpos($text, '[lesson:summary_html]');
        $containsSummary     = strpos($text, '[lesson:summary]');

        if ($containsSummaryHtml !== false || $containsSummary !== false) {
            if ($containsSummaryHtml !== false) {
                $text = str_replace(
                    '[lesson:summary_html]',
                    Lesson::renderHtml($_lessonFromRepository),
                    $text
                );
            }
            if ($containsSummary !== false) {
                $text = str_replace(
                    '[lesson:summary]',
                    Lesson::renderText($_lessonFromRepository),
                    $text
                );
            }
        }

        if ($this->meetingPointId) {
            if (strpos($text, '[lesson:meeting_point]') !== false) {
                $text = str_replace('[lesson:meeting_point]', $usefulObject->name, $text);
            }
        }

        $text = (strpos($text, '[lesson:instructor_name]') !== false) and $text = str_replace('[lesson:instructor_name]', $instructorOfLesson->firstname, $text);

        if (strpos($text, '[lesson:start_date]') !== false) {
            $text = str_replace('[lesson:start_date]', $this->start_time->format('d/m/Y'), $text);
        }

        if (strpos($text, '[lesson:start_time]') !== false) {
            $text = str_replace('[lesson:start_time]', $this->start_time->format('H:i'), $text);
        }

        if (strpos($text, '[lesson:end_time]') !== false) {
            $text = str_replace('[lesson:end_time]', $this->end_time->format('H:i'), $text);
        }

        return $text;
    }
}
