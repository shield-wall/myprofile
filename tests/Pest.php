<?php

declare(strict_types=1);

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;
use function Pest\Faker\faker;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

// uses(Tests\TestCase::class)->in('Feature');

uses(WebTestCase::class)->in('Functional');

dataset('page_list', [
    //TODO this test requires that refresh database.
//    'User social network' => [
//        '/profile/en/user-social-network',
//        [
//            'user_social_networking[link]' => faker()->url(),
//        ],
//    ],
    'Education' => [
        '/profile/en/education',
        [
            'education[title]' => faker()->jobTitle(),
            'education[institution]' => faker()->name(),
            'education[description]' => faker()->text(),
            'education[period_start]' => faker()->date(),
        ],
    ],
    'Experience' => [
        '/profile/en/experience',
        [
            'experience[title]' => faker()->jobTitle(),
            'experience[company]' => faker()->name(),
            'experience[description]' => faker()->text(),
            'experience[period_start]' => faker()->date(),
        ],
    ],
    'Certification' => [
        '/profile/en/certification',
        [
            'certification[title]' => faker()->jobTitle(),
            'certification[institution]' => faker()->name(),
            'certification[periodStart]' => faker()->date(),
            'certification[link]' => faker()->url(),
            'certification[image]' => faker()->imageUrl(),
        ],
    ],
    'User language' => [
        '/profile/en/user-language',
        [
            'user_language[name]' => faker()->name(),
        ],
    ],
    'Skill' => [
        '/profile/en/skill',
        [
            'skill[name]' => faker()->colorName(),
            'skill[levelExperience]' => faker()->numberBetween(0, 100),
            'skill[priority]' => faker()->numberBetween(0, 100),
        ],
    ],
]);

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toHaveTag', function (string $tag, $value = null) {
    $crawler = $this->value;

    if (!$crawler instanceof Crawler) {
        throw new Exception(sprintf('You need to pass %s object in expect', Crawler::class));
    }

    $expect = expect($crawler->filter($tag)->text())->toBeTruthy();

    if ($value) {
        $expect->toBe($value);
    }

    return $expect;
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

//function something()
//{
    // ..
//}
