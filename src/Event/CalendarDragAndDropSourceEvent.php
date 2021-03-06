<?php

/*
 * This file is part of the Kimai time-tracking app.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Event;

use App\Calendar\DragAndDropSource;
use App\Entity\User;
use Symfony\Contracts\EventDispatcher\Event;

final class CalendarDragAndDropSourceEvent extends Event
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var DragAndDropSource[]
     */
    private $sources = [];

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function addSource(DragAndDropSource $source): CalendarDragAndDropSourceEvent
    {
        $this->sources[] = $source;

        return $this;
    }

    public function removeSource(DragAndDropSource $source): bool
    {
        $key = array_search($source, $this->sources, true);
        if (false === $key) {
            return false;
        }

        unset($this->sources[$key]);

        return true;
    }

    /**
     * @return DragAndDropSource[]
     */
    public function getSources(): array
    {
        return array_values($this->sources);
    }
}
