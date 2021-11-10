CREATE TABLE IF NOT EXISTS "users" (
  "user_id" SERIAL PRIMARY KEY NOT NULL,
  "user_name" VARCHAR(50) NOT NULL,
  "user_password_hash" VARCHAR(255) NOT NULL,
  "user_email" VARCHAR(64) NOT NULL,
  UNIQUE("user_name"),
  UNIQUE("user_email")
);

COMMENT ON COLUMN users.user_id IS 'Tabla de id del usuario, unique index';
COMMENT ON COLUMN users.user_name IS 'nombre de usuario, unico';
COMMENT ON COLUMN users.user_password_hash IS 'Contraseña del usuario, en hash';
COMMENT ON COLUMN users.user_email IS 'Email del usuario, y es unico';
COMMENT ON TABLE users IS 'Datos de los usuarios';

CREATE TABLE IF NOT EXISTS "case_status" (
  "status_id" SERIAL PRIMARY KEY NOT NULL,
  "status" VARCHAR(50) NOT NULL,
  UNIQUE("status")
);

INSERT INTO case_status (status)
VALUES 
    ('Creado'),
    ('En proceso'),
    ('Terminado')
;

CREATE TABLE IF NOT EXISTS "case_priority" (
  "priority_id" SERIAL PRIMARY KEY NOT NULL,
  "priority" VARCHAR(50) NOT NULL,
  UNIQUE("priority")
);

INSERT INTO case_priority (priority)
VALUES 
    ('Urgente'),
    ('Importante'),
    ('Puede esperar')
;

CREATE TABLE IF NOT EXISTS "case"(
  "case_id" SERIAL PRIMARY KEY NOT NULL,
  "subject" VARCHAR(50) NOT NULL,
  "description" VARCHAR(600) NOT NULL,
  "price" VARCHAR(10) NOT NULL,
  "case_status" INTEGER REFERENCES case_status (status_id) DEFAULT 1,
  "case_priority"  INTEGER REFERENCES case_priority (priority_id) DEFAULT 3,
  "image" varchar(150) DEFAULT 'default_case_picture.png'
);