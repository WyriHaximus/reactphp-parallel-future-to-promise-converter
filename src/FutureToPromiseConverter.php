<?php declare(strict_types=1);

namespace WyriHaximus\React\Parallel;

use parallel\Future;
use React\EventLoop\LoopInterface;
use React\EventLoop\TimerInterface;
use React\Promise\Promise;
use React\Promise\PromiseInterface;

final class FutureToPromiseConverter
{
    /** @var LoopInterface */
    private $loop;

    public function __construct(LoopInterface $loop)
    {
        $this->loop = $loop;
    }

    public function convert(Future $future): PromiseInterface
    {
        return new Promise(function ($resolve, $reject) use ($future): void {
            /** @var TimerInterface|null $timer */
            $timer = $this->loop->addPeriodicTimer(0.001, function () use (&$timer, $future, $resolve, $reject): void {
                if (!$future->done()) {
                    return;
                }

                if ($timer instanceof TimerInterface) {
                    $this->loop->cancelTimer($timer);
                }

                try {
                    $resolve($future->value());
                } catch (\Throwable $throwable) {
                    $reject($throwable);
                }
            });
        });
    }
}
