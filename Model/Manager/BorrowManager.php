<?php 

class BorrowManager extends Manager{
    public static function getBorrowedItem(User $borrower):array{
        try{
            $query='SELECT * FROM borrow WHERE id_item=:id';
            $pst=self::startquery($query);
            $pst->bindValue('id',$borrower->getId());
            $pst->execute();
            $retour=[];
            while($row=$pst->fetch()){
                $borrow=new Borrow($row['id'],$borrower,DateTime::createFromFormat('Y-m-d',$row['startdate']),DateTime::createFromFormat('Y-m-d',$row['enddate']),ItemManager::getItem($row['id_item']));
                array_push($retour,$borrow);
            }
            return $retour;
        }
        catch(PDOException $pdoe){
            //todo gérer
        }
    }
}