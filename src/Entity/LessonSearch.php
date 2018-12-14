<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class LessonSearch
{
    /**
     * @var string|null
     */
    private $grade;
    /**
     * @var string|null
     */
    private $type;

    /**
     * @return string|null
     */
    public function getGrade(): ?string
    {
        return $this->grade;
    }

    /**
     * @var string|null
     */
    private $subject;
    /**
     * @param string|null $grade
     * @return LessonSearch
     */

    public function setGrade(?string $grade): LessonSearch
    {
        $this->grade = $grade;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return LessonSearch
     */
    public function setType(?string $type): LessonSearch
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param string|null $subject
     * @return LessonSearch
     */
    public function setSubject(?string $subject): LessonSearch
    {
        $this->subject = $subject;
        return $this;
    }


}