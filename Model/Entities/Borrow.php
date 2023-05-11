<?php

class Borrow implements JsonSerializable{
    private int $id;
    private Item $item;
    private User $borrower;
    private DateTime $start;
    private DateTime $end;

    function __construct(int $id,User $borrower,DateTime $start,DateTime $end,Item $item)
    {
        $this->setId($id)->setBorrower($borrower)->setStart($start)->setEnd($end)->setItem($item);
    }
    /**
     * Get the value of item
     *
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }

    /**
     * Set the value of item
     *
     * @param Item $item
     *
     * @return self
     */
    public function setItem(Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get the value of borrower
     *
     * @return User
     */
    public function getBorrower(): User
    {
        return $this->borrower;
    }

    /**
     * Set the value of borrower
     *
     * @param User $borrower
     *
     * @return self
     */
    public function setBorrower(User $borrower): self
    {
        $this->borrower = $borrower;

        return $this;
    }

    /**
     * Get the value of start
     *
     * @return DateTime
     */
    public function getStart(): DateTime
    {
        return $this->start;
    }

    /**
     * Set the value of start
     *
     * @param DateTime $start
     *
     * @return self
     */
    public function setStart(DateTime $start): self
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get the value of end
     *
     * @return DateTime
     */
    public function getEnd(): DateTime
    {
        return $this->end;
    }

    /**
     * Set the value of end
     *
     * @param DateTime $end
     *
     * @return self
     */
    public function setEnd(DateTime $end): self
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id'=>$this->id,
            'item'=>$this->item,
            'borrower'=>$this->borrower,
            'start'=>$this->start->format('Y-m-d'),
            'end'=>$this->end->format('Y-m-d')
        ];
    }
}