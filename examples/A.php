<?php


class A
{
    /** @var mixed  */
    private mixed $value;

    /** @var mixed  */
    private mixed $otherValue;

    /**
     * A constructor.
     *
     * @param null $value
     */
    public function __construct($value, $otherValue)
    {
        $this->value = $value;
        $this->otherValue = $otherValue;
    }

    /**
     * @return mixed
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getOtherValue(): mixed
    {
        return $this->otherValue;
    }

    /**
     * @param mixed $otherValue
     */
    public function setOtherValue(mixed $otherValue): void
    {
        $this->otherValue = $otherValue;
    }
}
