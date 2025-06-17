-- Tabla: Horse
CREATE TABLE Horse (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100),
  photo_path VARCHAR(255),
  breed VARCHAR(100),
  color VARCHAR(50),
  date_birth DATE,
  gender ENUM('macho', 'hembra'),
  father_id INT,
  mother_id INT,
  caretaker_id INT,
  created_at DATETIME,
  updated_at DATETIME,
  FOREIGN KEY (father_id) REFERENCES Horse(id),
  FOREIGN KEY (mother_id) REFERENCES Horse(id),
  FOREIGN KEY (caretaker_id) REFERENCES Caretaker(id)
);

-- Tabla: Caretaker
CREATE TABLE Caretaker (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100),
  phone VARCHAR(20),
  address VARCHAR(255),
  created_at DATETIME,
  updated_at DATETIME
);

-- Tabla: Training
CREATE TABLE Training (
  id INT PRIMARY KEY AUTO_INCREMENT,
  horse_id INT,
  date DATE,
  distance INT,
  duration_minutes INT,
  comments TEXT,
  created_at DATETIME,
  updated_at DATETIME,
  FOREIGN KEY (horse_id) REFERENCES Horse(id)
);

-- Tabla: Food
CREATE TABLE Food (
  id INT PRIMARY KEY AUTO_INCREMENT,
  horse_id INT,
  date DATE,
  type_food VARCHAR(100),
  quantity DECIMAL(5,2),
  time TIME,
  notes TEXT,
  created_at DATETIME,
  updated_at DATETIME,
  FOREIGN KEY (horse_id) REFERENCES Horse(id)
);

-- Tabla: Race
CREATE TABLE Race (
  id INT PRIMARY KEY AUTO_INCREMENT,
  horse_id INT,
  date_race DATE,
  place VARCHAR(100),
  distance INT,
  result INT,
  jockey VARCHAR(100),
  created_at DATETIME,
  updated_at DATETIME,
  FOREIGN KEY (horse_id) REFERENCES Horse(id)
);

-- Tabla: VetVisit
CREATE TABLE VetVisit (
  id INT PRIMARY KEY AUTO_INCREMENT,
  horse_id INT,
  date_visit DATE,
  veterinarian_name VARCHAR(100),
  diagnosis TEXT,
  treatment TEXT,
  next_visit DATE,
  created_at DATETIME,
  updated_at DATETIME,
  FOREIGN KEY (horse_id) REFERENCES Horse(id)
);

-- Tabla: CalendarEvent
CREATE TABLE CalendarEvent (
  id INT PRIMARY KEY AUTO_INCREMENT,
  horse_id INT,
  title VARCHAR(100),
  description TEXT,
  event_date DATE,
  event_time TIME,
  category ENUM('entrenamiento', 'veterinario', 'carrera', 'otro'),
  created_at DATETIME,
  updated_at DATETIME,
  FOREIGN KEY (horse_id) REFERENCES Horse(id)
);

-- Tabla: User (roles)
CREATE TABLE User (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  role ENUM('admin', 'cuidador', 'veterinario'),
  created_at DATETIME,
  updated_at DATETIME
);

-- Tabla: Expense (gastos)
CREATE TABLE Expense (
  id INT PRIMARY KEY AUTO_INCREMENT,
  horse_id INT,
  date DATE,
  category ENUM('comida', 'veterinario', 'medicamento', 'cuidador', 'jockey', 'otro'),
  description TEXT,
  amount DECIMAL(10,2),
  created_at DATETIME,
  updated_at DATETIME,
  FOREIGN KEY (horse_id) REFERENCES Horse(id)
);
