<?php

declare(strict_types=1);

namespace GreekSocialInsuranceNumber;

final class GreekSocialInsuranceNumber
{
    const MALE = 'male';
    const FEMALE = 'female';

    private $number;

    private $dateOfBirth;

    /**
     * @param string $number
     * @throws InvalidGreekSocialInsuranceNumberException
     */
    public function __construct(string $number)
    {
        self::assert($number);
        $this->number = trim($number);
        $this->dateOfBirth = \DateTimeImmutable::createFromFormat('dmy', substr($number, 0, 6));
    }

    /**
     * @param string $number
     * @throws InvalidGreekSocialInsuranceNumberException
     */
    public static function assert(string $number)
    {
        $number = trim($number);
        if ($number === '') {
            throw new InvalidGreekSocialInsuranceNumberException('Social Insurance number (AMKA) can not be an empty string');
        }

        if (is_numeric($number) === false || ((int)$number) === 0) {
            throw new InvalidGreekSocialInsuranceNumberException(
                sprintf('Social Insurance number (AMKA) %s is not a numeric value.', $number)
            );
        }

        if (strlen($number) !== 11) {
            throw new InvalidGreekSocialInsuranceNumberException(
                sprintf('Length of %s Social Insurance number (AMKA) is invalid', $number)
            );
        }

        $dateOfBirthCompare = \DateTimeImmutable::createFromFormat('dmy', substr($number, 0, 6));
        if ($dateOfBirthCompare === false) {
            throw new InvalidGreekSocialInsuranceNumberException(
                sprintf('The date of birth part of %s Social insurance number (AMKA) is invalid', $number)
            );
        }
    }

    /**
     * @return string
     */
    public function getRegistrationNumber(): string
    {
        return substr($this->number, 6, 4);
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDateOfBirth(): \DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return ($this->getRegistrationNumber() % 2 === 0) ? self::FEMALE : self::MALE;
    }

    /**
     * @return string
     */
    public function getControlDigit(): string
    {
        return substr($this->number, 10, 1);
    }
}