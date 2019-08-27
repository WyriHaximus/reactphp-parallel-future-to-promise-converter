<?php declare(strict_types=1);

namespace WyriHaximus\React\Tests\Parallel;

use parallel\Future;
use parallel\Runtime;
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;
use function Safe\sleep;
use WyriHaximus\AsyncTestUtilities\AsyncTestCase;
use WyriHaximus\React\Parallel\FutureToPromiseConverter;

/**
 * @internal
 */
final class FutureToPromiseConverterTest extends AsyncTestCase
{
    public function testConvertSuccess(): void
    {
        $loop = Factory::create();
        $converter = new FutureToPromiseConverter($loop);
        $runtime = new Runtime(dirname(__DIR__) . '/vendor/autoload.php');

        /** @var Future $future */
        $future = $runtime->run(function () {
            sleep(3);

            return 3;
        });

        $loop->run();
        $three = $this->await($converter->convert($future), $loop, 3.3);

        self::assertSame(3, $three);
    }

    public function testConvertFailure(): void
    {
        self::expectException(\Exception::class);
        self::expectExceptionMessage('Rethrow exception');

        $loop = Factory::create();
        $converter = new FutureToPromiseConverter($loop);
        $runtime = new Runtime(dirname(__DIR__) . '/vendor/autoload.php');

        /** @var Future $future */
        $future = $runtime->run(function (): void {
            sleep(3);

            throw new \Exception('Rethrow exception');
        });

        $loop->run();
        $three = $this->await($converter->convert($future), $loop, 3.3);

        self::assertSame(3, $three);
    }
}
