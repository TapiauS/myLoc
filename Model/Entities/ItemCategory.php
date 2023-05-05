<?php

class ItemCategory implements JsonSerializable{

    private int $id;

    private string $name;

    private int $associatedpoints;

    function __construct(int $id,string $name,int $associatedpoints)
    {
        $this->setId($id)->setName($name)->setAssociatedpoints($associatedpoints);
    }



    /**
     * Get the value of name
     *
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the value of associatedpoints
     *
     * @return int
     */
    public function getAssociatedpoints(): int {
        return $this->associatedpoints;
    }

    /**
     * Set the value of associatedpoints
     * Cant be negative
     * @param int $associatedpoints
     *
     * @return self
     */
    public function setAssociatedpoints(int $associatedpoints): self {
        if($associatedpoints<0)
            $this->associatedpoints=0;
        else
            $this->associatedpoints = $associatedpoints;
        return $this;
    }

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'points'=>$this->associatedpoints,
        ];
    }
}