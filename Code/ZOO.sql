CREATE TABLE habitats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom varchar(250),
    description varchar(1000)
);

CREATE TABLE animaux (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom varchar(250),
    Type_alimentaire varchar(250),
    id_hab INT ,
    FOREIGN KEY (id_hab) REFERENCES habitats(id),
    imgsrc varchar(10000)
);

INSERT INTO habitats (nom,description)
VALUES('Forêt','Habitat constitué d’arbres et de végétation dense'),
('Desert','Habitat sec, aride, avec peu de végétation'),
('Océan','Habitat marin, vaste étendue d’eau salée'),
('Savane','Habitat tropical d’herbes hautes avec quelques arbres dispersés');


INSERT INTO animaux (nom,Type_alimentaire,id_hab,imgsrc)
VALUES
('Lion', 'Carnivore',4, 'lion.jpg'),
('Tigre', 'Carnivore', 4, 'tigre.jpg'),
('Zèbre', 'Herbivore', 4, 'zebre.jpg'),
('Poisson clown', 'Omnivore',3 , 'poisson.jpg'),
('Grenouille', 'Insectivore', 1, 'grenouille.jpg');

UPDATE animaux
SET Type_alimentaire='Insectivore' where nom='Grenouille';

UPDATE animaux
SET id_hab=1 where Type_alimentaire='Insectivore';

DELETE FROM animaux where id=3;

DELETE FROM animaux where id_hab=4 AND nom='Lion';

SELECT * FROM animaux;