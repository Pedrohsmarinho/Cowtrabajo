drop database if exists web20192coworking;

create database web20192coworking;
use web20192coworking;

create table cursos (
    id integer primary key auto_increment,
    nome varchar(64)
);

insert into cursos(nome) values
    ('Técnico em Informática para Internet'),
    ('Técnico em Logística'),
    ('Tecnológico em Qualidade'),
    ('Tecnológico em Sistemas para Internet');

create table usuarios (
    id integer primary key auto_increment,
    nome varchar(128) not null,
    curso_id integer not null,
    matricula varchar(32) not null,
    mac varchar(32), -- endereço MAC de um dispositivo que queira registrar na rede especial
    email varchar(128) not null,
    senha varchar(128) not null,

    foreign key (curso_id) references cursos(id)
);

create table turnos (
    id integer primary key auto_increment,
    nome varchar(32),
    hora_inicial varchar(16),
    hora_final varchar(16)
);

insert into turnos(nome, hora_inicial, hora_final) values
    ('manha', '08:00', '12:00'),
    ('tarde', '12:00', '17:00'),
    ('noite', '17:00', '20:00');

create table reservas (
    id integer primary key auto_increment,
    usuario_id integer not null,
    dia_da_semana integer not null, -- 0 = domingo, 1 = segunda, ...
    turno_id integer not null,

    foreign key (usuario_id) references usuarios(id),
    foreign key (turno_id) references turnos(id)
);



-- ---------------------------- --
-- ---------------------------- --
-- ---------------------------- --
--      Dados para Teste        --
-- ---------------------------- --
-- ---------------------------- --
-- ---------------------------- --

insert into usuarios(nome, curso_id, matricula, mac, email, senha) values  -- senha: sha1("teste")
    ('Shantel Wineinger', 3, 'if8369', null, 'shantel@email.com', '2e6f9b0d5885b6010f9167787445617f553a735f'),
    ('Maggie Saide', 2, 'if4023', null, 'maggie@email.com', '2e6f9b0d5885b6010f9167787445617f553a735f'),
    ('Carlotta Gruenes', 3, 'if4183', null, 'carlotta@email.com', '2e6f9b0d5885b6010f9167787445617f553a735f'),
    ('Tamela Presler', 4, 'if4139', null, 'tamela@email.com', '2e6f9b0d5885b6010f9167787445617f553a735f'),
    ('Junior Evanski', 3, 'if9954', null, 'junior@email.com', '2e6f9b0d5885b6010f9167787445617f553a735f'),
    ('Stevie Banchero', 1, 'if9051', null, 'stevie@email.com', '2e6f9b0d5885b6010f9167787445617f553a735f');

insert into reservas (usuario_id, dia_da_semana, turno_id) values
    (1, 4, 1),
    (3, 3, 1),
    (6, 1, 2),
    (1, 4, 1),
    (1, 3, 3),
    (2, 5, 3),
    (5, 2, 3),
    (2, 4, 3),
    (3, 3, 1),
    (1, 2, 3),
    (1, 1, 2),
    (6, 1, 1);