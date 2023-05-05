<?php

class User implements JsonSerializable{
    private int $id;

    private String $pseudo;

    private String $password;

    private Role $role;

    private String $town;

    private String $adress;

    private int $points;


    function __construct(int $id,String $pseudo,String $password,Role $role,String $town,String $adress,int $points)
    {
        $this->setId($id)->setPseudo($pseudo)->setPassword($password)->setRole($role)->setTown($town)->setAdress($adress)->setPoints($points);
    }



    

    /**
     * Get the value of points
     */ 
    public function getPoints():int
    {
        return $this->points;
    }

    /**
     * Set the value of points
     *
     * @return  self
     */ 
    public function setPoints(int $points):self
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get the value of adress
     */ 
    public function getAdress():String
    {
        return $this->adress;
    }

    /**
     * Set the value of adress
     *
     * @return  self
     */ 
    public function setAdress(String $adress):self
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get the value of town
     */ 
    public function getTown():String
    {
        return $this->town;
    }

    /**
     * Set the value of town
     *
     * @return  self
     */ 
    public function setTown(String $town):self
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get the value of role
     *
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @param Role $role
     *
     * @return self
     */
    public function setRole(Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return String
     */
    public function getPassword(): String
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param String $password
     *
     * @return self
     */
    public function setPassword(String $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of pseudo
     *
     * @return String
     */
    public function getPseudo(): String
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @param String $pseudo
     *
     * @return self
     */
    public function setPseudo(String $pseudo): self
    {
        $this->pseudo = $pseudo;

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
            "id"=>$this->id,
            "pseudo"=>$this->pseudo,
            "town"=>$this->town,
            "adress"=>$this->adress,
            "points"=>$this->points
        ];
    }
}