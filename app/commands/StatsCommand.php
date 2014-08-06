<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class StatsCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'stats:course';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Work out the course statistics';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->info('Update mean grade point and workload level');
        Course::updateAllMeans();

        $this->info('Calculate Bayesian average, m = ' . Config::get('cityuge.bayesianAvgMinCommentNum'));
        Course::updateBayesianAverages(Config::get('cityuge.bayesianAvgMinCommentNum'));

        if ($this->argument('purge')) {
            $this->info('Purge cache');
            Cache::forget('homeStats');
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('purge', InputArgument::OPTIONAL, 'Purge cache.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array();
    }

}
