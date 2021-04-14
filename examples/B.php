<?php


class B
{
    /** @var mixed  */
    private mixed $value;

    /**
     * B constructor.
     *
     * @param null $value
     */
    public function __construct($value = null)
    {
        $this->value = $value;
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
}
