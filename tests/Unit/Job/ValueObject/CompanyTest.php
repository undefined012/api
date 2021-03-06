<?php

declare(strict_types=1);

namespace PostAJob\API\Job\ValueObject;

use Error;
use PostAJob\API\Job\ValueObject\Exception\CompanyIsEmpty;
use PostAJob\API\Job\ValueObject\Exception\CompanyIsTooLong;
use PostAJob\API\Job\ValueObject\Exception\CompanyIsTooShort;
use PostAJob\API\TestCase;

final class CompanyTest extends TestCase
{
    /**
     * @test
     * @dataProvider tooLongCompanyValue
     */
    public function should_thrown_a_company_is_too_long_exception(string $value): void
    {
        $this->expectException(CompanyIsTooLong::class);
        new Company($value);
    }

    public function tooLongCompanyValue(): array
    {
        return [
            ['values' => 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'],
            ['values' => '  AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA '],
        ];
    }

    /**
     * @test
     * @dataProvider tooShortCompanyValue
     */
    public function should_thrown_a_company_is_too_short_exception(string $value): void
    {
        $this->expectException(CompanyIsTooShort::class);
        new Company($value);
    }

    public function tooShortCompanyValue(): array
    {
        return [
            ['values' => 'a'],
            ['values' => '  s '],
        ];
    }

    /**
     * @test
     * @dataProvider invalidCompanyValue
     */
    public function should_thrown_a_company_is_empty_exception(string $value): void
    {
        $this->expectException(CompanyIsEmpty::class);
        new Company($value);
    }

    public function invalidCompanyValue(): array
    {
        return [
            ['values' => ''],
            ['values' => '  '],
        ];
    }

    /**
     * @test
     * @dataProvider validCompanyValue
     */
    public function should_thrown_an_exception_because_is_impossible_to_clone(string $value): void
    {
        $this->expectException(Error::class);
        $company = new Company($value);
        clone $company;
    }

    /**
     * @test
     * @dataProvider validCompanyValue
     */
    public function should_return_true_when_comparing_equal_objects(string $value): void
    {
        $company1 = new Company($value);
        $company2 = new Company($value);
        $this->assertTrue($company1->equals($company2));
    }

    /**
     * @test
     */
    public function should_return_false_when_comparing_different_objects(): void
    {
        $company1 = new Company('Google');
        $company2 = new Company('Amazon');
        $this->assertFalse($company1->equals($company2));
    }

    /**
     * @test
     * @dataProvider validCompanyValue
     */
    public function should_return_the_same_property_that_has_been_injected(string $value, string $expectedValue): void
    {
        $company = new Company($value);
        $this->assertSame($expectedValue, $company->value());
        $this->assertSame($expectedValue, (string) $company);
    }

    public function validCompanyValue(): array
    {
        return [
            ['givenValue' => 'Google', 'expectedValue' => 'Google'],
            ['givenValue' => ' Google ', 'expectedValue' => 'Google'],
        ];
    }
}
