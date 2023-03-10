create DATABASE login_credentials;
CREATE Table `user_pass` (username VARCHAR(20) NOT NULL,password VARCHAR(20) NOT NULL);
insert into `user_pass` (username, password)
values ("admin","password");

select password from user_pass where username="admin";
use login_credentials;
create TABLE user_pass  (name varchar(20) NOT NULL, mailid VARCHAR(50) NOT NULL, userid VARCHAR(20) NOT NULL, pass VARCHAR(15) NOT NULL);


select * from user_pass;

TRUNCATE table user_pass;

INSERT INTO user_pass(name, mailid, userid, pass) values('veer','v@g.in','veer007','password');