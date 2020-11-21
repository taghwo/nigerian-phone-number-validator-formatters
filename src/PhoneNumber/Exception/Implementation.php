<?php
namespace Taghwo\PhoneNumber\Exception;

use Taghwo\PhoneNumber\Exception\ExceptionInterface;

use InvalidArgumentException;

class Implementation extends InvalidArgumentException implements ExceptionInterface
{
}
