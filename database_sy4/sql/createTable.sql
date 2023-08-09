-- 新建数据库
drop database if exists leasing_luxury;
create database if not exists leasing_luxury;
use leasing_luxury;

-- 新建顾客信息表，包含：顾客id，姓名，电话号码，身份证号码，邮箱地址，邮寄地址
create table customer(
    customer_id int not null auto_increment,
    first_name varchar(15),
    last_name varchar(15),
    phone varchar(15),
    creditID varchar(15),
    emailAdd varchar(15),
    regularAdd varchar(15),
    primary key(customer_id),
    unique(creditID)
);

-- 新建包信息表，包含：包id，包名，包颜色，所属设计师，价格，包数量
create table bags(
    bag_id int not null,
    names varchar(15),
    Color varchar(15),
    Manufacturer varchar(15),
    Price float not null,
    nums int not null,
    primary key(bag_id)
);

-- 新建租借信息表，包含：租借id，顾客id，租借日期，归还日期，保险金，包id，包状态
create table rentals(
    rentals_id int not null auto_increment,
    customer_id int not null,
    DateRent Date,
    DateReturn Date,
    Insurance boolean,
    bag_id int not null,
    bag_state varchar(15),
    foreign key(bag_id) references bags(bag_id),
    foreign key(customer_id) references customer(customer_id),
    primary key(rentals_id,customer_id, DateRent, bag_id),
    unique(rentals_id, customer_id, DateRent, bag_id)
);