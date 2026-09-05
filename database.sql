CREATE TABLE admin (
  id int(11) NOT NULL,
  username varchar(50) NOT NULL,
  passwor varchar(255) NOT NULL
)


CREATE TABLE kategori_produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL
);

CREATE TABLE produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_kategori INT NOT NULL,
    nama_produk VARCHAR(100) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    gambar VARCHAR(255),
    FOREIGN KEY (id_kategori) REFERENCES kategori_produk(id)
);

CREATE TABLE detail_produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_produk INT NOT NULL,
    nama VARCHAR(100),
    harga DECIMAL(10,2),
    link_produk VARCHAR(255),
    keterangan1 TEXT,
    keterangan2 TEXT,
    keterangan3 TEXT,
    keterangan4 TEXT,
    keterangan5 TEXT,
    keterangan6 TEXT,
    keterangan7 TEXT,
    keterangan8 TEXT,
    deskripsi TEXT,
    FOREIGN KEY (id_produk) REFERENCES produk(id)
);

CREATE TABLE gambar_detail_produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_detail_produk INT NOT NULL,
    gambar VARCHAR(255),
    FOREIGN KEY (id_detail_produk) REFERENCES detail_produk(id)
);
