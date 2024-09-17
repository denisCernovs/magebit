<?php

namespace Magebit\Faq\Api\Data;

use Magento\Framework\Stdlib\DateTime;

interface QuestionInterface {

    public const STATUS_DISABLED = 0;
    public const STATUS_ENABLED = 1;

    public function getQuestionId(): int;
    public function setQuestionId(int $id);
    public function getQuestion(): string;
    public function setQuestion(string $question);
    public function getAnswer(): string;
    public function setAnswer(string $answer);
    public function getStatus(): int;
    public function setStatus(int $status);
    public function getPosition(): int;
    public function setPosition(int $position);
    public function getUpdatedAt(): DateTime;
    public function setUpdatedAt(DateTime $updatedAt);

}
