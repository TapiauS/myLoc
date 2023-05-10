<?php

class MylocManagerException extends Exception{
    private int $lvl;

    function __construct(string $message,Exception $previous,int $level=0,$code=0)
    {
        $this->setLvl($level);
        parent::__construct($message,$code,$previous);
    } 

    /**
     * Get the value of lvl
     *
     * @return int
     */
    public function getLvl(): int {
        return $this->lvl;
    }

    /**
     * Set the value of lvl
     *
     * @param int $lvl
     *
     * @return self
     */
    public function setLvl(int $lvl): self {
        $this->lvl = $lvl;
        return $this;
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message} (level={$this->lvl})\n";
    }
}