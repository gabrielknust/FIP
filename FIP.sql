create database FIP default charset utf8;

use FIP;

create table Endereco(
id_endereco int auto_increment not null,
cep varchar(14),
bairro varchar(50),
rua varchar(100),
referencia varchar(500),
primary key(id_endereco)
)engine = innoDB;

create table Poste(
id_poste int auto_increment not null primary key,
id_endereco int not null,
foto mediumtext,
numeracao int,
foreign key(id_endereco) references Endereco(id_endereco)
);

create table Ocorrencia(
id_ocorrencia int auto_increment not null primary key,
id_poste int not null,
classificaUrgencia varchar(500),
descricaoUrgencia varchar(10000),
foreign key(id_poste) references Poste(id_poste)
);