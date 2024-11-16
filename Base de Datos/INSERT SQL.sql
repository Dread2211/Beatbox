insert into roles(rol) values ('Normal') , ('Artista'), ('Moderador');

insert into usuarios(usuario, nombre, telefono, email, rol) values ('@juanito', 'Juan Perez', 1122222222, 'juanito@gmail.com', 2), 
('@anderson', 'Anderson Suarez', 1133333333, 'anderson@gmail.com', 1), ('@renzo', 'Renzo Raico', 1144444444, 'renzo@gmail.com', 1), 
('@mariana', 'Mariana Fernandez', 1155555555, 'marianaf@gmail.com', 3), ('@uli', 'Ulises Ramos', 1155555555, 'ulises@gmail.com', 2)

insert into red(usuario_1, usuario_2) values (2, 3), (4, 1);

insert into moderacion(control) values ('Aprobado', 'En revision', 'Desaprobado')

insert into formato(nombre) values ('Cancion', 'Podcast');

insert into contenido(formato, duracion, titulo, favorito, aprobado, artista) values (1, 2:33, 'La Ciruela', 2, 1, 1), 
(2, 45:09, 'Como hacer pizza', 1, 2, 2);

insert into historial(fecha, duracion, id_usuario, id_cancion) values (31-05-2024, 1:05:22, 3, 1)

insert into






SELECT u1.usuario, u1.nombre, u2.usuario, u2.nombre, r.id
FROM red r 
INNER JOIN usuarios u1 ON r.usuario_1 = u1.id 
INNER JOIN usuarios u2 ON r.usuario_2 = u2.id;