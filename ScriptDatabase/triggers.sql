CREATE OR REPLACE FUNCTION checkBorrowing() RETURNS TRIGGER AS $$
DECLARE
activborrow INT[];
activlend INT[];
BEGIN
    SELECT ARRAY_AGG(id_user) FROM borrow WHERE id_user=OLD.id INTO activborrow;
    SELECT ARRAY_AGG(id_item) FROM borrow 
        JOIN item ON item.id=id_item
        JOIN _user ON _user.id=OLD.id AND item.id_user=_user.id INTO activlend;
    IF activborrow!=NULL OR activlend!=NULL THEN
        RAISE EXCEPTION 'Delete of user not allowed with active item' USING ERRCODE ='useditem';
    END IF;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE TRIGGER del_user
    BEFORE DELETE ON _user
    FOR EACH ROW EXECUTE PROCEDURE checkBorrowing();