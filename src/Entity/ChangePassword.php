<?php

namespace App\Entity;

use App\Repository\ChangePasswordRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChangePasswordRepository::class)
 */
class ChangePassword
{

    
    public $oldPassword;

    
    public $newPassword;
}
