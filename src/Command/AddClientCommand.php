<?php
/**
 * @copyright Macintoshplus (c) 2022
 * Added by : Macintoshplus at 28/10/2022 18:11
 */

declare(strict_types=1);

namespace App\Command;


use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: "client:add")]
final class AddClientCommand extends Command
{

    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->addArgument('name', InputArgument::REQUIRED);
        $this->addArgument('redirectUrl', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new Client();
        $client->setName($input->getArgument('name'));
        $client->setRedirectUri($input->getArgument('redirectUrl'));
        $client->setIdentifier(str_replace(['+', '/', '='], '', base64_encode(random_bytes(16))));

        $client->setSecret(str_replace(['+', '/', '='], '', base64_encode(random_bytes(32))));

        $this->entityManager->persist($client);
        $this->entityManager->flush();

        $output->writeln('Client ID : '.$client->getIdentifier());
        $output->writeln('Client Secret : '.$client->getSecret());

        return self::SUCCESS;
    }
}
