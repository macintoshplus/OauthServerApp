<?php
namespace Jbnahan\ServerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('jbnahan:oauth-server:user:create')
            ->setDescription('Creates a new user')
            ->addOption(
                'name',
                null,
                InputOption::VALUE_REQUIRED,
                'Sets user name. The email is username@nahan.fr',
                null
            )
            ->setHelp(
                <<<EOT
                    The <info>%command.name%</info>command creates a new user.

<info>php %command.full_name% [--redirect-uri=...] [--grant-type=...] name</info>

EOT
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $user = new \Jbnahan\ServerBundle\Entity\User();
        $encoder = $this->getContainer()->get('security.encoder_factory')->getEncoder($user);

        $username = $input->getOption('name');
        $user->setUsername($username);
        $user->setEmail($username."@nahan.fr");
        $password = $encoder->encodePassword($username, $user->getSalt());
        $user->setPassword($password);

        $em->persist($user);
        $em->flush();

        $output->writeln(
            sprintf(
                'Added a new user id <info>%s</info>',
                $user->getId()
            )
        );
    }
}
