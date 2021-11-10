CREATE TABLE users (
  user_id INT PRIMARY KEY AUTO_INCREMENT,
  user_name VARCHAR(50) NOT NULL,
  user_password_hash VARCHAR(255) NOT NULL,
  user_email VARCHAR(64) NOT NULL,
  UNIQUE(user_name),
  UNIQUE(user_email)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS case_status (
  status_id INT PRIMARY KEY AUTO_INCREMENT,
  status VARCHAR(50) NOT NULL,
  UNIQUE(status)
);

INSERT INTO case_status (status)
VALUES 
    ('Creado'),
    ('En proceso'),
    ('Terminado')
;

CREATE TABLE IF NOT EXISTS case_priority (
  priority_id INT PRIMARY KEY AUTO_INCREMENT,
  priority VARCHAR(50) NOT NULL,
  UNIQUE(priority)
);

INSERT INTO case_priority (priority)
VALUES 
    ('Urgente'),
    ('Importante'),
    ('Puede esperar')
;

CREATE TABLE IF NOT EXISTS case_t(
  case_id INT PRIMARY KEY AUTO_INCREMENT,
  subject VARCHAR(50) NOT NULL,
  description VARCHAR(600) NOT NULL,
  price VARCHAR(10) NOT NULL,
  case_status INT,
  case_priority INT,
  image varchar(150) DEFAULT 'default_case_picture.png',
  FOREIGN KEY(case_status) REFERENCES case_status(status_id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY(case_priority) REFERENCES case_priority(priority_id) ON DELETE CASCADE ON UPDATE CASCADE
);