CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    birth_date DATE,
    role ENUM('user', 'admin') DEFAULT 'user',
    username VARCHAR(50),
    banner VARCHAR(255),
    avatar VARCHAR(255),
    about TEXT,
    country VARCHAR(50),
    city VARCHAR(50),
    address VARCHAR(255),
    postal_code VARCHAR(20),
    remember_token VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    is_published BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    moderated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    email VARCHAR(100) NOT NULL,
    motif VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    event_date DATE NOT NULL,
    nb_places INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO users (first_name, last_name, email, password_hash, phone, birth_date, role, username, banner, avatar, about, country, city, address, postal_code, remember_token)
VALUES
('Alice', 'Dupont', 'alice.dupont@example.com', 'hashedpwd1', '0601020304', '1990-05-12', 'user', 'alice_d', NULL, NULL, 'Aime lire et voyager.', 'France', 'Paris', '123 Rue de Paris', '75001', NULL),
('Marc', 'Durand', 'marc.durand@example.com', 'hashedpwd2', '0611121314', '1985-11-20', 'user', 'marcd', NULL, NULL, 'Fan de foot.', 'France', 'Lyon', '45 Avenue Jean Jaurès', '69007', NULL),
('Claire', 'Martin', 'claire.martin@example.com', 'hashedpwd3', '0622233445', '1992-07-08', 'user', 'clairem', NULL, NULL, 'Passionnée de photo.', 'Belgique', 'Bruxelles', '10 Rue Royale', '1000', NULL),
('Lucas', 'Petit', 'lucas.petit@example.com', 'hashedpwd4', '0633344556', '1998-03-15', 'user', 'lucaspetit', NULL, NULL, 'Amateur de cinéma.', 'Suisse', 'Genève', '8 Chemin Vert', '1203', NULL),
('Julie', 'Bernard', 'julie.bernard@example.com', 'hashedpwd5', '0644455566', '1995-09-30', 'user', 'julieb', NULL, NULL, 'Cuisine et randonnée.', 'France', 'Toulouse', '67 Rue des Fleurs', '31000', NULL),
('Nicolas', 'Robert', 'nicolas.robert@example.com', 'hashedpwd6', '0655566677', '1987-02-21', 'user', 'nrobert', NULL, NULL, 'Gamer et développeur.', 'France', 'Nice', '25 Promenade des Anglais', '06000', NULL),
('Sophie', 'Lemoine', 'sophie.lemoine@example.com', 'hashedpwd7', '0666677788', '1993-12-05', 'user', 'slem', NULL, NULL, 'Écriture et arts.', 'Canada', 'Montréal', '200 Rue Sainte-Catherine', 'H2X 1L1', NULL),
('Antoine', 'Fabre', 'antoine.fabre@example.com', 'hashedpwd8', '0677788899', '1990-08-19', 'user', 'antfab', NULL, NULL, 'Voyages et histoire.', 'France', 'Bordeaux', '12 Cours Victor Hugo', '33000', NULL),
('Camille', 'Giraud', 'camille.giraud@example.com', 'hashedpwd9', '0688899900', '1996-04-10', 'user', 'camgiraud', NULL, NULL, 'Nature et animaux.', 'France', 'Lille', '89 Rue de la Liberté', '59000', NULL),
('Julien', 'Moreau', 'julien.moreau@example.com', 'hashedpwd10', '0699900011', '1989-06-25', 'user', 'jmoreau', NULL, NULL, 'Musique et sport.', 'France', 'Marseille', '14 Boulevard Longchamp', '13001', NULL);

INSERT INTO comments (user_id, content, is_published, moderated_at)
VALUES
(1, 'Super article, merci pour le partage !', TRUE, CURRENT_TIMESTAMP),
(2, 'Je ne suis pas tout à fait d’accord avec ce point.', TRUE, CURRENT_TIMESTAMP),
(3, 'Très intéressant, j’aimerais en savoir plus.', FALSE, NULL),
(4, 'Bravo pour cette initiative.', TRUE, CURRENT_TIMESTAMP),
(5, 'Peut-on avoir plus de détails ?', FALSE, NULL),
(6, 'Je recommande vivement ce site.', TRUE, CURRENT_TIMESTAMP),
(7, 'Merci pour les infos.', TRUE, CURRENT_TIMESTAMP),
(8, 'À quand la suite ?', FALSE, NULL),
(9, 'Je trouve ça utile pour les débutants.', TRUE, CURRENT_TIMESTAMP),
(10, 'Je reviendrai lire les prochaines publications.', TRUE, CURRENT_TIMESTAMP);

INSERT INTO messages (user_id, email, motif, message, is_read)
VALUES
(1, 'alice.dupont@example.com', 'Question', 'Bonjour, j’ai une question sur votre service.', FALSE),
(2, 'marc.durand@example.com', 'Support', 'Je rencontre un bug sur la page de profil.', TRUE),
(3, 'claire.martin@example.com', 'Suggestion', 'Serait-il possible d’ajouter un mode sombre ?', FALSE),
(4, 'lucas.petit@example.com', 'Autre', 'Je souhaite supprimer mon compte.', TRUE),
(5, 'julie.bernard@example.com', 'Question', 'Comment modifier mon mot de passe ?', TRUE),
(6, 'nicolas.robert@example.com', 'Support', 'Mon avatar ne s’affiche plus.', FALSE),
(7, 'sophie.lemoine@example.com', 'Suggestion', 'Une appli mobile serait top !', FALSE),
(8, 'antoine.fabre@example.com', 'Autre', 'Merci pour votre travail !', TRUE),
(9, 'camille.giraud@example.com', 'Question', 'Est-ce que l’on peut réserver pour plusieurs personnes ?', FALSE),
(10, 'julien.moreau@example.com', 'Support', 'Je ne reçois pas l’email de confirmation.', TRUE);

INSERT INTO reservations (user_id, event_date, nb_places)
VALUES
(1, '2025-07-10', 2),
(2, '2025-07-12', 1),
(3, '2025-07-15', 4),
(4, '2025-07-20', 3),
(5, '2025-07-18', 1),
(6, '2025-07-25', 2),
(7, '2025-07-28', 1),
(8, '2025-07-30', 5),
(9, '2025-08-01', 2),
(10, '2025-08-05', 1);