<?php

namespace FreeBet\Bundle\SoccerLeagueBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use FreeBet\Bundle\CompetitionBundle\Document\Repository\CompetitionRepository;
use FreeBet\Bundle\SoccerLeagueBundle\Scraper\WebScraperChain;

/**
 * GenerateMatchCommand
 *
 * @author jobou
 */
class GenerateMatchCommand extends Command
{
    /**
     * @var \FreeBet\Bundle\CompetitionBundle\Document\Repository\CompetitionRepository
     */
    private $competitionRepository;

    /**
     * @var \FreeBet\Bundle\SoccerLeagueBundle\Scraper\WebScraperChain
     */
    private $scraperChain;

    /**
     * Constructor
     *
     * @param \FreeBet\Bundle\CompetitionBundle\Document\Repository\CompetitionRepository $competitionRepository
     * @param \FreeBet\Bundle\SoccerLeagueBundle\Scraper\WebScraperChain $scraperChain
     */
    public function __construct(CompetitionRepository $competitionRepository, WebScraperChain $scraperChain)
    {
        $this->competitionRepository = $competitionRepository;
        $this->scraperChain = $scraperChain;

        parent::__construct();
    }

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('free-bet:generate-match')
            ->setDescription('Generate League Match')
            ->addArgument('league-slug', InputArgument::REQUIRED)
            ->addOption('data-source', '-d', InputOption::VALUE_REQUIRED, 'The site providing the data', 'lequipe')
            ->addOption('file', '-f', InputOption::VALUE_REQUIRED, 'The site providing the data')
        ;
    }

    /**
     * Execute the command
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $leagueSlug = $input->getArgument('league-slug');
        $competition = $this->competitionRepository->findOneBySlug($leagueSlug);
        if (!$competition) {
            $output->writeln('<error>competition '.$leagueSlug.' does not exist</error>');
            exit(1);
        }

        $dataSource = $input->getOption('data-source');
        $dataLoader = $this->scraperChain->getScraper($dataSource);
        if (!$dataLoader) {
            $output->writeln('<error>scraper '.$dataSource.' does not exist</error>');
            exit(1);
        }

        $file = $input->getOption('file');
        if (!$file) {
            $file = dirname(__FILE__).'/../Resources/data/'.$leagueSlug.'.yml';
        }

        $content = $dataLoader->refreshMatchData();
        file_put_contents($file, $content);
        $output->writeln('Write content to file '.$file);
    }
}
