<?php

declare(strict_types=1);

namespace GreekSocialInsuranceNumber\Tests;

use GreekSocialInsuranceNumber\GreekSocialInsuranceNumber;
use PHPUnit\Framework\TestCase;

final class GreekSocialInsuranceNumberTest extends TestCase
{
    /**
     * @test
     */
    public function initializingObjectWithAValidNumber()
    {
        $number = new GreekSocialInsuranceNumber('24018701234');
        $this->assertSame('4', $number->getControlDigit());
        $this->assertSame('1987-01-24', $number->getDateOfBirth()->format('Y-m-d'));
        $this->assertSame(GreekSocialInsuranceNumber::MALE, $number->getGender());
        $number = new GreekSocialInsuranceNumber('24018701224');
        $this->assertSame(GreekSocialInsuranceNumber::FEMALE, $number->getGender());
    }

    /**
     * @test
     * @expectedException \GreekSocialInsuranceNumber\InvalidGreekSocialInsuranceNumberException
     */
    public function initializingObjectWillFailBecauseOfEmptyString()
    {
        new GreekSocialInsuranceNumber('');
    }

    /**
     * @test
     * @expectedException \GreekSocialInsuranceNumber\InvalidGreekSocialInsuranceNumberException
     * @expectedExceptionMessage Length of 123451234512345 Social Insurance number (AMKA) is invalid
     */
    public function initializingObjectWillInvalidLength()
    {
        new GreekSocialInsuranceNumber('123451234512345');
    }

    /**
     * @test
     * @expectedException \GreekSocialInsuranceNumber\InvalidGreekSocialInsuranceNumberException
     * @expectedExceptionMessage Social Insurance number (AMKA) a1234567890 is not a numeric value.
     */
    public function initializingObjectWillNonNumeric()
    {
        new GreekSocialInsuranceNumber('a1234567890');
    }
}
