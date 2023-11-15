CREATE TABLE user (
  id_user INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50),
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  url_profpic VARCHAR(100),
  is_admin BOOLEAN DEFAULT false
);
CREATE TABLE podcast (
  id_podcast INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(50),
  url_thumbnail VARCHAR(100),
  description VARCHAR(1000),
  category VARCHAR(50),
  id_user INT NOT NULL,
  FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE
);
CREATE TABLE episode (
  id_episode INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(50),
  description VARCHAR(1000),
  url_thumbnail VARCHAR(100),
  url_audio VARCHAR(100),
  id_podcast INT NOT NULL,
  FOREIGN KEY (id_podcast) REFERENCES podcast(id_podcast) ON DELETE CASCADE
);
CREATE TABLE playlist (
  id_playlist INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(50),
  id_user INT NOT NULL,
  FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE
);
CREATE TABLE podcast_x_playlist (
  id_playlist INT,
  id_podcast INT,
  PRIMARY KEY (id_playlist, id_podcast),
  FOREIGN KEY (id_playlist) REFERENCES playlist(id_playlist) ON DELETE CASCADE,
  FOREIGN KEY (id_podcast) REFERENCES podcast(id_podcast) ON DELETE CASCADE
);
INSERT INTO user (
    name,
    username,
    password,
    url_profpic,
    is_admin
  )
VALUES (
    "Penggendong Handal",
    "test_user",
    "ini_password",
    "/images/default-profpic.jpeg",
    0
  );