<?php
/**
 * @copyright Macintoshplus (c) 2022
 * Added by : Macintoshplus at 28/10/2022 17:47
 */

declare(strict_types=1);

namespace App\Command;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(name: "user:add")]
final class AddUserCommand extends Command
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }


    protected function configure()
    {
        $this->addArgument('login', InputArgument::REQUIRED, 'User Login');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sf = new SymfonyStyle($input, $output);

        $password = $sf->askHidden('Password');

        $user = new User();
        $user->setEmail($login = $input->getArgument('login'));
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));

        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $sf->success('User "' . $login . '" added');
        return self::SUCCESS;
    }

}
