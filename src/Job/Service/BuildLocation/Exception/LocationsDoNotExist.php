<?php

declare(strict_types=1);

namespace PostAJob\API\Job\Service\BuildLocation\Exception;

use RuntimeException;

final class LocationsDoNotExist extends RuntimeException
{
    private const ERROR_MESSAGE = 'One or more of the given locations "%s" does not exist. If it exists contact us.';

    public function __construct(array $locations)
    {
        parent::__construct(\sprintf(self::ERROR_MESSAGE, \implode(', ', $locations)));
    }
}
