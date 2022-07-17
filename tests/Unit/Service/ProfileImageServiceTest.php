<?php

namespace App\Tests\Unit\Service;

use App\Entity\User;
use App\Service\ProfileImageService;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use transloadit\Transloadit;

it('is passing always the path to transloadit configuration', function (string $getProfileImageUrl) {
    // Mocks
    $paramMock = mock(ParameterBagInterface::class)->expect(
        get: fn ($name) => 1,
    );

    $transloaditMock = $this->createMock(Transloadit::class);
    $transloaditMock
        ->method('createAssembly')
        ->with($this->callback(function(array $configs) {
            return $configs['params']['steps']['export']['path'] === '/image/path/fake.png'
                && $configs['params']['steps']['export']['url_prefix'] === 'https://cdn.foo.bar/prefix/';
        }));

    $userMock = mock(User::class)
        ->shouldReceive('getProfileImage')
        ->andReturn($getProfileImageUrl)
        ->once()
        ->getMock();

    $fileMock = $this->createMock(UploadedFile::class);

    $profileImageServiceMock = $this
        ->getMockBuilder(ProfileImageService::class)
        ->setConstructorArgs([$transloaditMock, $paramMock, 'https://cdn.foo.bar/prefix', 'https://bucket.foo.bar/prefix'])
        ->onlyMethods(['removeFile'])
        ->getMock();

    // Run code
    $profileImageServiceMock->upload($userMock, $fileMock);
})->with([
    ["https://bucket.foo.bar/prefix/image/path/fake.png"],
    ["https://cdn.foo.bar/prefix/image/path/fake.png"],
    ["/image/path/fake.png"],
]);