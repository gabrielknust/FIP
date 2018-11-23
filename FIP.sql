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
numeracao varchar(50),
foreign key(id_endereco) references Endereco(id_endereco)
)engine = innoDB;

create table Ocorrencia(
id_ocorrencia int auto_increment not null primary key,
id_poste int not null,
classificaUrgencia varchar(500),
descricaoUrgencia varchar(1000),
foreign key(id_poste) references Poste(id_poste)
)engine = innoDB;

DELIMITER &&

CREATE PROCEDURE cadOcorrencia (in cep varchar(14), in bairro varchar(50), in rua varchar(100), in referencia varchar(500),
in foto longtext, in numeracao varchar(50), in classificaUrgencia varchar(500), in descricaoUrgencia varchar(1000))

begin
	
declare idE int;
declare idP int;

insert into Endereco(cep, bairro, rua, referencia)
	values(cep, bairro, rua, referencia);

SELECT MAX(id_endereco)
	INTO idE FROM Endereco;
    
insert into Poste(id_endereco, foto, numeracao)
	values(idE, foto, numeracao);

SELECT MAX(id_poste)
	INTO idP FROM Poste;
    
insert into Ocorrencia(id_poste, classificaUrgencia, descricaoUrgencia)
	values(idP, classificaUrgencia, descricaoUrgencia);
    
end &&

CREATE PROCEDURE delOcorrencia (in id_o int, in id_p int, in id_e int)

begin

DELETE FROM Ocorrencia WHERE id_ocorrencia = id_o;
DELETE FROM Poste WHERE id_poste = id_p;
DELETE FROM Endereco WHERE id_endereco = id_e;

end &&
DELIMITER ;
