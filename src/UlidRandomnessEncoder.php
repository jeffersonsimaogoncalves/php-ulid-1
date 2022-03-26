<?php

namespace lewiscowles\core;

use lewiscowles\core\ValueTypes\PositiveNumber;

final class UlidRandomnessEncoder implements RandomnessEncoderInterface
{
    private const ENCODING = '0123456789ABCDEFGHJKMNPQRSTVWXYZ';
    private const ENCODING_LENGTH = 32;

    /** @var RandomFloatInterface */
    private $randomFloatSource;

    public function __construct(RandomFloatInterface $randomFloatSource)
    {
        $this->randomFloatSource = $randomFloatSource;
    }

    public function encode(PositiveNumber $desiredLength): string
    {
        $out = '';
        for ($i = 0; $i < $desiredLength->getValue(); $i++) {
            $rand = (int) floor(self::ENCODING_LENGTH * $this->randomFloatSource->generate());
            $out = self::ENCODING[$rand] . $out;
        }

        return $out;
    }
}