<?php


namespace App\Tests\Functional\Controller\Profile;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class MainPageTest extends WebTestCase
{
    protected $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testCanSeeNotificationToUsersNoActivated()
    {
        /** @var UserRepository $userRepository */
        $userRepository = self::$container->get(UserRepository::class);
        $user = $userRepository->findOneBy(['email' => 'test@myprofile.pro']);

        $this->client->loginUser($user);

        $crawler = $this->client->request(Request::METHOD_GET, '/profile/pt_BR/edit');

        $this->assertEquals(0, $crawler->filter('#verify-account')->count());

        $user = $userRepository->findOneBy(['email' => 'not-verified@myprofile.pro']);

        $this->client->loginUser($user);

        $crawler = $this->client->request(Request::METHOD_GET, '/profile/pt_BR/edit');

        $this->assertEquals(1, $crawler->filter('#verify-account')->count());
    }
}