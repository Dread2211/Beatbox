-- Create database if not exists and use it
CREATE DATABASE IF NOT EXISTS `beatbox` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `beatbox`;

-- Create tables

CREATE TABLE IF NOT EXISTS `roles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `rol` VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rol` (`rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(50) DEFAULT NULL,
  `nombre` VARCHAR(50) DEFAULT NULL,
  `telefono` INT(11) DEFAULT NULL,
  `email` VARCHAR(50) DEFAULT NULL,
  `rol` INT(11) DEFAULT NULL,
  `contrasena` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `telefono` (`telefono`),
  UNIQUE KEY `email` (`email`),
  KEY `rol` (`rol`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `formato` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `moderacion` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `control` VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `contenido` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `state` VARCHAR(50) NOT NULL,
  `format` INT(11) DEFAULT NULL,
  `duration` TIME DEFAULT NULL,
  `title` VARCHAR(50) DEFAULT NULL,
  `fav` TINYINT(1) DEFAULT NULL,
  `approved` INT(11) DEFAULT NULL,
  `artist` INT(11) DEFAULT NULL,
  `lyric` LONGTEXT DEFAULT NULL,
  `img` VARCHAR(255) DEFAULT NULL,
  `src` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `artist` (`artist`),
  KEY `approved` (`approved`),
  KEY `format` (`format`),
  CONSTRAINT `contenido_ibfk_1` FOREIGN KEY (`artist`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `contenido_ibfk_2` FOREIGN KEY (`approved`) REFERENCES `moderacion` (`id`),
  CONSTRAINT `contenido_ibfk_3` FOREIGN KEY (`format`) REFERENCES `formato` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `generos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tipo` (`tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `etiqueta` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_generos` INT(11) DEFAULT NULL,
  `id_contenido` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_generos` (`id_generos`),
  KEY `id_contenido` (`id_contenido`),
  CONSTRAINT `etiqueta_ibfk_1` FOREIGN KEY (`id_generos`) REFERENCES `generos` (`id`),
  CONSTRAINT `etiqueta_ibfk_2` FOREIGN KEY (`id_contenido`) REFERENCES `contenido` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `historial` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME DEFAULT NULL,
  `duracion` TIME DEFAULT NULL,
  `id_usuario` INT(11) DEFAULT NULL,
  `id_cancion` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_cancion` (`id_cancion`),
  CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `historial_ibfk_2` FOREIGN KEY (`id_cancion`) REFERENCES `contenido` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `tipo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `informacion` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tipo` INT(11) NOT NULL,
  `titulo` VARCHAR(50) NOT NULL,
  `aprobado` INT(11) DEFAULT NULL,
  `texto` LONGTEXT DEFAULT NULL,
  `autor` VARCHAR(50) NOT NULL,
  `scr` VARCHAR(255) DEFAULT NULL,
  `id_contenido` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_contenido` (`id_contenido`),
  KEY `tipo` (`tipo`),
  KEY `aprobado` (`aprobado`),
  CONSTRAINT `informacion_ibfk_1` FOREIGN KEY (`id_contenido`) REFERENCES `contenido` (`id`),
  CONSTRAINT `informacion_ibfk_2` FOREIGN KEY (`tipo`) REFERENCES `tipo` (`id`),
  CONSTRAINT `informacion_ibfk_3` FOREIGN KEY (`aprobado`) REFERENCES `moderacion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `playlist` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha_creada` DATE DEFAULT NULL,
  `nombre` VARCHAR(50) DEFAULT NULL,
  `favorito` TINYINT(1) DEFAULT NULL,
  `img` VARCHAR(255) DEFAULT NULL,
  `id_contenido` INT(11) DEFAULT NULL,
  `usuario_id` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_contenido` (`id_contenido`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`id_contenido`) REFERENCES `contenido` (`id`),
  CONSTRAINT `playlist_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `red` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario_1` INT(11) DEFAULT NULL,
  `usuario_2` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_1` (`usuario_1`),
  KEY `usuario_2` (`usuario_2`),
  CONSTRAINT `red_ibfk_1` FOREIGN KEY (`usuario_1`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `red_ibfk_2` FOREIGN KEY (`usuario_2`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert de data
INSERT INTO `roles` (`id`, `rol`) VALUES
(2, 'Artista'),
(3, 'Moderador'),
(1, 'Normal');

-- Insertar formato para canción
INSERT INTO formato (nombre) VALUES ('Canción'), ('Podcast');

INSERT INTO usuarios (usuario, nombre, telefono, email, rol, contrasena)
VALUES 
('olivia_r', 'Olivia Rodrigo', NULL, 'olivia@example.com', 2, 'hashed_password'),
('patricio_r', 'Patricio Rey y sus Redonditos de Ricota', NULL, 'patricio@example.com', 2, 'hashed_password'),
('dillom_r', 'Dillom', NULL, 'dillom@example.com', 2, 'hashed_password'),
('sabrina_c', 'Sabrina Carpenter', NULL, 'sabrina@example.com', 2, 'hashed_password'),
('miranda_r', 'Miranda!', NULL, 'miranda@example.com', 2, 'hashed_password'),
('tan_bionica_r', 'Tan Bionica', NULL, 'tanbionica@example.com', 2, 'hashed_password'),
('lady_gaga_r', 'Lady Gaga', NULL, 'ladygaga@example.com', 2, 'hashed_password');

SELECT id, nombre FROM usuarios WHERE nombre IN (
    'Olivia Rodrigo', 
    'Patricio Rey y sus Redonditos de Ricota', 
    'Dillom', 
    'Sabrina Carpenter', 
    'Miranda!', 
    'Tan Bionica', 
    'Lady Gaga'
);

-- Reemplaza ARTISTA_ID con los valores correspondientes de la consulta previa

INSERT INTO contenido (state, format, duration, title, fav, approved, artist, lyric, img, src) VALUES 
('visible', 1, '00:03:39', 'Vampire', 0, NULL, (SELECT id FROM usuarios WHERE nombre = 'Olivia Rodrigo'), 'Hate to give the satisfaction, asking how you\'re doing now, ...', 'img/sour.webp', 'music/Olivia Rodrigo - vampire .mp3'),

('visible', 1, '00:02:23', 'JiJiJi', 0, NULL, (SELECT id FROM usuarios WHERE nombre = 'Patricio Rey y sus Redonditos de Ricota'), 'En este film velado en blanca noche, ...', 'img/oktubre.jpg', 'music/Patricio Rey y sus Redonditos de Ricota - Jijiji.mp3'),

('visible', 1, '00:03:23', 'La Carie', 0, NULL, (SELECT id FROM usuarios WHERE nombre = 'Dillom'), 'Dios mío, dame, mi sueño de paz, ...', 'img/porCesarea.jpg', 'music/La Carie.mp3'),

('visible', 1, '00:03:06', 'Please Please Please', 0, NULL, (SELECT id FROM usuarios WHERE nombre = 'Sabrina Carpenter'), '(Please, please, please, don\'t prove I\'m right), ...', 'img/Pleasex3.jpeg', 'music/Sabrina Carpenter - Please Please Please.mp3'),

('visible', 1, '00:03:13', 'Enamorada', 0, NULL, (SELECT id FROM usuarios WHERE nombre = 'Miranda!'), 'Al momento de ser realista, ...', 'img/enamorada.jfif', 'music/Miranda! - Enamorada.mp3'),

('visible', 1, '00:04:26', 'Obsesionario en La Mayor', 0, NULL, (SELECT id FROM usuarios WHERE nombre = 'Tan Bionica'), 'Después de la lluvia, ...', 'img/obsesionario.jpeg', 'music/Obsesionario en La Mayor.mp3'),

('visible', 1, '00:03:57', 'Poker Face', 0, NULL, (SELECT id FROM usuarios WHERE nombre = 'Lady Gaga'), '', 'img/the-fame.jpeg', 'music/Lady Gaga - Poker Face.mp3');


commit;