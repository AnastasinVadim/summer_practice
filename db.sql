CREATE TABLE CLIENTS (
    client_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100),
    passport VARCHAR(20)
);

CREATE TABLE CARS (
    car_id INT AUTO_INCREMENT PRIMARY KEY,
    model VARCHAR(50),
    year INT,
    license_plate VARCHAR(15),
    insurance_value DECIMAL(10, 2),
    rental_cost DECIMAL(10, 2)
);

CREATE TABLE RENTALS (
    rental_id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    car_id INT,
    start_date DATE,
    rental_days INT,
    FOREIGN KEY (client_id) REFERENCES CLIENTS(client_id),
    FOREIGN KEY (car_id) REFERENCES CARS(car_id)
);
