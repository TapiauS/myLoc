<?php

class Item implements JsonSerializable{
    private int $id;

    private User $owner;

    private ?String $description;

    private String $name;

    private ItemCategory $category;

    private ?String $pictureName;


    function __construct(int $id,User $owner,?String $description,ItemCategory $category,?String $pictureName,string $name)
    {
        $this->setName($name)->setId($id)->setOwner($owner)->setDescription($description)->setCategory($category)->setPictureName($pictureName);
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

    /**
     * Get the value of owner
     *
     * @return User
     */
    public function getOwner(): User
    {
        return $this->owner;
    }

    /**
     * Set the value of owner
     *
     * @param User $owner
     *
     * @return self
     */
    public function setOwner(User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get the value of description
     *
     * @return String
     */
    public function getDescription(): ?String
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param String $description
     *
     * @return self
     */
    public function setDescription(?String $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of name
     *
     * @return String
     */
    public function getName(): String
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param String $name
     *
     * @return self
     */
    public function setName(String $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of category
     *
     * @return ItemCategory
     */
    public function getCategory(): ItemCategory
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @param ItemCategory $category
     *
     * @return self
     */
    public function setCategory(ItemCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the value of pictureName
     *
     * @return String
     */
    public function getPictureName(): ?String
    {
        return $this->pictureName;
    }

    /**
     * Set the value of pictureName
     *
     * @param String $pictureName
     *
     * @return self
     */
    public function setPictureName(?String $pictureName): self
    {
        $this->pictureName = $pictureName;

        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id'=>$this->id,
            'idowner'=>$this->owner->getId(),
            'name'=>$this->name,
            'description'=>$this->description,
            'catégorie'=>$this->category
        ];
    }
}