CREATE OR REPLACE FUNCTION addPoints() RETURNS TRIGGER AS $$
DECLARE
added_points INT;
BEGIN
    SELECT associated_points FROM category_item  
            JOIN item ON id_category_item=category_item.id AND item.id=NEW.id_item AND item.id_user!=NEW.id_user 
            INTO added_points;
    IF added_points IS NOT NULL THEN
        UPDATE _user SET points=(SELECT points FROM _user WHERE _user.id=NEW.id_user)+added_points;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE trigger pointsUpdate()
    BEFORE INSERT ON borrow 
    FOR EACH ROW EXECUTE PROCEDURE addPoints();



CREATE OR REPLACE FUNCTION delete_goods()
RETURNS trigger AS
$$
BEGIN
    IF EXISTS (SELECT 1 FROM borrow WHERE id_user = OLD.id_user AND CURRENT_DATE BETWEEN startdate AND enddate) THEN
        RAISE EXCEPTION 'User still has rented goods';
    END IF;
    RETURN NEW;
END;
$$
LANGUAGE plpgsql;

CREATE TRIGGER delete_goods_trigger
    BEFORE DELETE ON _user
    FOR EACH ROW
    EXECUTE FUNCTION delete_goods();