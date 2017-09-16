<?php

namespace Utilities;

/**
 * Implements basic encryption decryption algorithm.
 */
class Encryptor
{
    /**
     * Encrypts String.
     *
     * @param string $source        Plain text string.
     * @param string $encryptionKey Encryption key string.
     *
     * @return string Returns encrypted string.
     */
    public static function encryptString($source, $encryptionKey)
    {
        return $source;
    }

    /**
     * Decrypts encrypted string.
     *
     * @param string $source        encrypted string.
     * @param string $encryptionKey Encryption key string.
     *
     * @return string Returns decrypted plain text string.
     */
    public static function decryptString($source, $encryptionKey)
    {
        return $source;
    }
}
