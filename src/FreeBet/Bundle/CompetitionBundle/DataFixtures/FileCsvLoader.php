<?php

namespace FreeBet\Bundle\CompetitionBundle\DataFixtures;

/**
 * Description of FileCsvLoader
 *
 * @author jobou
 */
class FileCsvLoader
{
    /**
     * Read a csv file
     *
     * @param string $fileName
     *
     * @return array
     */
    public function readFile($fileName)
    {
        $data = array();

        $file = fopen($fileName, 'r');
        while ($line = fgetcsv($file)) {
            $data[] = $line;
        }

        return $data;
    }
}
