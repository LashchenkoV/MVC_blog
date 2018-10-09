<?php
/**
 * Created by PhpStorm.
 * User: mamedov
 * Date: 27.09.2018
 * Time: 18:54
 */

namespace app\configuration;


class PassHashConfiguration
{
    const ALGORITHM = 'sha256';
    const SALT_POS = 3;
    const SALT_LEN = 5;
}