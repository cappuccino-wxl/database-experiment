use leasing_luxury;
drop procedure if exists bags_for_manufacturer;
 
DELIMITER //  
create procedure bags_for_manufacturer(in name varchar(15))
begin
    select names, Color, Manufacturer
    from bags
    where Manufacturer = name;
end // 
DELIMITER ;  