create database provlog;

use provlog;
CREATE TABLE user (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user varchar(255),
    pwd varchar(255)
);

insert into user 
(user, pwd) 
values 
("fred","fred");

CREATE TABLE entregas (
id int AUTO_INCREMENT PRIMARY KEY NOT NULL,
num_pedido bigint NOT NULL,
id_cliente bigint NOT NULL,
nome_recebedor VARCHAR(300),
cpf_recebedor VARCHAR(14),/*XXX.XXX.XXX-XX*/
data_hora_entrega VARCHAR(50)/*XX/XX/XXXX XX:XX*/
);

insert into entregas 
(num_pedido, id_cliente) 
values 
(12345,966);
insert into entregas 
(num_pedido, id_cliente,
nome_recebedor, cpf_recebedor,
data_hora_entrega) 
values 
(10000,966,
"Astrogildo","966.966.966-96",
"11/11/2011 11:11");