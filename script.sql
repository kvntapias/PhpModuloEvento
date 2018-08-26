USE eventnow;
create table Evento(
    id int PRIMARY KEY auto_increment,
    titulo varchar(50) not null,
    categoria varchar(20) not null,
    imagen varchar(150) not null,
    descripcion varchar(500) not null,
   	fecha varchar(30) not null,
   	horaI varchar(20) not null,
   	horaF varchar(20) not null,
   	ubicacion varchar(70) not null,
   	tipo varchar(15) not null);

create table Usuario(
  id int PRIMARY KEY auto_increment,
  nombre varchar(30),
  usuario varchar(30),
  contraseña varchar(32)
);

insert into Usuario(nombre,usuario,contraseña) values('kevin','kvn','123');