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
        $this->number = $number;
        $this->dateOfBirth = \DateTimeImmutable::createFromFormat('dmy', substr($number, 0, 6));
    }

    /**
     * @param string $socialInsuranceNumber
     * @param string|null $gender
     * @param \DateTimeInterface|null $dateOfBirth
     * @throws InvalidGreekSocialInsuranceNumberException
     */
    public static function assert(
        string $socialInsuranceNumber,
        string $gender = null,
        \DateTimeInterface $dateOfBirth = null
    ) {
        $socialInsuranceNumber = trim($socialInsuranceNumber);
        if (strlen($socialInsuranceNumber) !== 11) {
            throw new InvalidGreekSocialInsuranceNumberException('Length of %s Social Insurance number (AMKA) is invalid', $socialInsuranceNumber);
        }

        if (is_numeric($socialInsuranceNumber) === false) {
            throw new InvalidGreekSocialInsuranceNumberException('Social Insurance number (AMKA) %s is not a numeric value.', $socialInsuranceNumber);
        }

        $dateOfBirthCompare = \DateTimeImmutable::createFromFormat('dmy', substr($socialInsuranceNumber, 0, 6));
        if ($dateOfBirthCompare === false) {
            throw new InvalidGreekSocialInsuranceNumberException('Date of birth part of Social insurance number is invalid');
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