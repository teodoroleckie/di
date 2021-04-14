<?php

namespace Tleckie\Di\Exception;

use Exception;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Class NotFoundException
 *
 * @package Tleckie\Di\Exception
 * @author  Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class NotFoundException extends Exception implements NotFoundExceptionInterface
{
}
