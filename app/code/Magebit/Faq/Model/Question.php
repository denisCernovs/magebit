<?php

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magento\Framework\Model\AbstractModel;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magento\Framework\Stdlib\DateTime;

class Question extends AbstractModel implements QuestionInterface {

    private const ID = 'id';
    private const QUESTION = 'question';
    private const ANSWER = 'answer';
    private const STATUS = 'status';
    private const POSITION = 'position';
    private const UPDATED_AT = 'updated_at';

    public function __construct()
    {
        $this->_eventPrefix = 'magebit_faq';
        $this->_eventObject = 'faq';
        $this->_idFieldName = self::ID;
        $this->_init(QuestionResource::class);
    }

    public function getId(): int
    {
        return (int) $this->getData(self::ID);
    }

    public function setId($id) {
        $this->setData(self::ID, $id);
    }

    public function getQuestion(): string
    {
        return (string) $this->getData(self::QUESTION);
    }

    public function setQuestion(string $question)
    {
        $this->setData(self::QUESTION, $question);
    }

    public function getAnswer(): string
    {
        return (string) $this->getData(self::ANSWER);
    }

    public function setAnswer(string $answer)
    {
        $this->setData(self::ANSWER, $answer);
    }

    public function getStatus(): int
    {
        return (int) $this->getData(self::STATUS);
    }

    public function setStatus(int $status)
    {
        $this->setData(self::STATUS, $status);
    }

    public function getPosition(): int
    {
        return (int) $this->getData(self::POSITION);
    }

    public function setPosition(int $position)
    {
        $this->setData(self::POSITION, $position);
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->getData(self::UPDATED_AT);
    }

    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
