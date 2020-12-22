<?php


namespace App\Tests\Functional\Controller\Profile;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Generator;

class IndexUserLanguageControllerTest extends WebTestCase
{
    /**
     * @param $userEmail
     * @param $quantityOfLanguages
     * @dataProvider usersProvider
     */
    public function testCanSeeMyLanguages($userEmail, $quantityOfLanguages)
    {
        $client = static::createClient();

        /** @var UserRepository $userRepository */
        $userRepository = self::$container->get(UserRepository::class);
        $user = $userRepository->findOneBy(['email' => $userEmail]);

        $client->loginUser($user);
        $crawler = $client->request(Request::METHOD_GET, '/profile/pt_BR/user-language#language');
        $this->assertResponseIsSuccessful();

        $this->assertEquals($quantityOfLanguages, $crawler->filter('tbody tr')->count());

    }

    public function usersProvider(): Generator
    {
        yield ['test@myprofile.pro', 1];
        yield ['test2@myprofile.pro', 3];
    }
}