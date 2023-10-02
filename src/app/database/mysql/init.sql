CREATE TABLE user (
  id_user INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50),
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(50) NOT NULL,
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
INSERT INTO user (username, password)
VALUES ("test_user", "ini_password");
INSERT INTO podcast (
    title,
    url_thumbnail,
    description,
    category,
    id_user
  )
VALUES (
    "Nama Podcast",
    "/images/sample-podcast.jpeg",
    "Ini adalah contoh teks deskripsi dummy yang dibuat oleh ChatGPT. Teks ini mengilustrasikan kemampuan model dalam menghasilkan teks deskripsi dengan panjang yang lebih besar. ChatGPT adalah AI canggih yang dirancang untuk memberikan informasi, menyelesaikan masalah, dan memberikan panduan dalam berbagai topik.",
    "Kategori Podcast",
    1
  );