<?php
namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;
    // hàm khởi tạo
    public function __construct(UserRepository $userRepository)  //Tham số này đại diện cho một đối tượng thuộc class UserRepository.

    {
        $this->userRepository = $userRepository;
    }

    public function getNewsByUserId($email)
    {
        $user = $this->userRepository->findEmail($email);

        if ($user) {
            return $user->news;
        }

        return [];
    }
}
