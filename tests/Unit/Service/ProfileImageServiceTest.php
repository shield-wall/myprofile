<?php

namespace App\Tests\Unit\Service;

use App\Entity\User;
use App\Service\ProfileImageService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use transloadit\Transloadit;

class ProfileImageServiceTest extends TestCase
{
    /**
     * @test
     * @testdox it is passing always the path to transloadit configuration.
     * @testWith ["https://bucket.foo.bar/prefix/image/path/fake.png"]
     *          ["https://cdn.foo.bar/prefix/image/path/fake.png"]
     *          ["/image/path/fake.png"]
     */
    public function passPathToConfiguration(string $getProfileImageUrl)
    {
        // Mocks
        $paramMock = $this->createMock(ParameterBagInterface::class);
        $paramMock
            ->method('get')
            ->willReturn(1);

        $transloaditMock = $this->createMock(Transloadit::class);
        $transloaditMock
            ->method('createAssembly')
            ->with($this->callback(function(array $configs) {
                return $configs['params']['steps']['export']['path'] === '/image/path/fake.png'
                    && $configs['params']['steps']['export']['url_prefix'] === 'https://cdn.foo.bar/prefix/';
            }));

        $userMock = $this->createMock(User::class);
        $userMock
            ->expects($this->once())
            ->method('getProfileImage')
            ->willReturn($getProfileImageUrl);

        $fileMock = $this->createMock(UploadedFile::class);

        $profileImageServiceMock = $this
            ->getMockBuilder(ProfileImageService::class)
            ->setConstructorArgs([$transloaditMock, $paramMock, 'https://cdn.foo.bar/prefix', 'https://bucket.foo.bar/prefix'])
            ->onlyMethods(['removeFile'])
            ->getMock();

        // Run code
        $profileImageServiceMock->upload($userMock, $fileMock);
    }
}