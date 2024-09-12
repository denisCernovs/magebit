<?php

namespace Magebit\Faq\Api\Data;

use Magento\Framework\Stdlib\DateTime;

interface QuestionInterface {

    public function getId(): int;
    public function setId(int $id);
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
