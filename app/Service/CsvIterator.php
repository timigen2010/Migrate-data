<?php

namespace App\Service;

/**
 * Итератор CSV-файлов.
 *
 * @author Josh Lockhart
 */

class CsvIterator implements \Iterator
{
    const ROW_SIZE = 4096;

    /**
     * The pointer to the cvs file.
     * @var resource
     * @access protected
     */
    protected $filePointer = NULL;

    /**
     * The current element, which will
     * be returned on each iteration.
     * @var array
     * @access protected
     */
    protected $currentElement = NULL;

    /**
     * The row counter.
     * @var int
     * @access protected
     */
    protected $rowCounter = NULL;

    /**
     * The delimiter for the csv file.
     * @var string
     * @access protected
     */
    protected $delimiter = NULL;

    /**
     * This is the constructor.It try to open the csv file.The method throws an exception
     * on failure.
     *
     * @access public
     * @param string $file The csv file.
     * @param string $delimiter The delimiter.
     *
     * @throws \Exception
     */
    public function __construct($file, $delimiter = ',')
    {
        try {
            $this->filePointer = fopen($file, 'rb');
            $this->delimiter = $delimiter;
        } catch (\Exception $e) {
            throw new \Exception('The file "' . $file . '" cannot be read.');
        }
    }

    /**
     * This method resets the file pointer.
     *
     * @access public
     */
    public function rewind()
    {
        $this->rowCounter = 0;
        rewind($this->filePointer);
    }

    /**
     * This method returns the current csv row as a 2 dimensional array
     *
     * @access public
     * @return array The current csv row as a 2 dimensional array
     */
    public function current()
    {
        $originalStr = fgets($this->filePointer, self::ROW_SIZE);
        $this->currentElement = array_map(function ($str){ return str_replace("\"", "", $str); },
            str_getcsv(trim($originalStr, '"')));
        $this->rowCounter++;

        return ['data' => $this->currentElement, 'original' => $originalStr];
    }

    /**
     * This method returns the current row number.
     *
     * @access public
     * @return int The current row number
     */
    public function key()
    {
        return $this->rowCounter;
    }

    /**
     * This method checks if the end of file is reached.
     *
     * @access public
     * @return boolean Returns true on EOF reached, false otherwise.
     */
    public function next()
    {
        if (is_resource($this->filePointer)) {
            return !feof($this->filePointer);
        }

        return false;
    }

    /**
     * This method checks if the next row is a valid row.
     *
     * @access public
     * @return boolean If the next row is a valid row.
     */
    public function valid()
    {
        if (!$this->next()) {
            if (is_resource($this->filePointer)) {
                fclose($this->filePointer);
            }

            return false;
        }

        return true;
    }
}
