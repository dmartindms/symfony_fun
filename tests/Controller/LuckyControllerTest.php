<?php

namespace App\Tests\Controller;

use App\Contracts\NumberGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LuckyControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
    }

    public function testMockNumberGeneratorInterface()
    {
        $numGenerator = $this->createMock(NumberGeneratorInterface::class);
        $numGenerator->expects(self::once())
            ->method('randomInt')
            ->willReturn(123);
        self::getContainer()->set(NumberGeneratorInterface::class, $numGenerator);


        $this->client->request('GET', '/lucky/number');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextSame('h1', 'Your lucky number is 123');
    }

    public function testDisplaysFormatCorrectly(): void
    {
        $this->getContainer()->set(NumberGeneratorInterface::class, new StubGeneratorInterface(42));

        $this->client->request('GET', '/lucky/number');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextSame('h1', 'Your lucky number is 42');
    }

    public function testHeaderCorrect(): void
    {
        $crawler = $this->client->request('GET', '/lucky/number');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Your lucky number is');
    }
}

class StubGeneratorInterface implements NumberGeneratorInterface
{
    public function __construct(public int $number)
    {
    }

    public function randomInt(): int
    {
        return $this->number;
    }
}