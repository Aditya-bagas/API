<?php

$db = new PDO('sqlite:database/database.sqlite');

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$users = [
    ['Andi Pratama', 'andi@example.com'],
    ['Budi Santoso', 'budi@example.com'],
    ['Citra Lestari', 'citra@example.com'],
    ['Dimas Saputra', 'dimas@example.com'],
    ['Eka Putri', 'eka@example.com'],
    ['Fajar Ramadhan', 'fajar@example.com'],
    ['Gita Maharani', 'gita@example.com'],
    ['Hendra Wijaya', 'hendra@example.com'],
    ['Intan Permata', 'intan@example.com'],
    ['Joko Susilo', 'joko@example.com'],
    ['Kiki Amelia', 'kiki@example.com'],
    ['Lukman Hakim', 'lukman@example.com'],
    ['Maya Sari', 'maya@example.com'],
    ['Nanda Prakoso', 'nanda@example.com'],
    ['Olivia Putri', 'olivia@example.com'],
    ['Putra Wijaya', 'putra@example.com'],
    ['Qori Aulia', 'qori@example.com'],
    ['Raka Firmansyah', 'raka@example.com'],
    ['Salsa Nabila', 'salsa@example.com'],
    ['Taufik Hidayat', 'taufik@example.com'],
    ['Umar Farhan', 'umar@example.com'],
    ['Vina Anggraini', 'vina@example.com'],
    ['Wahyu Setiawan', 'wahyu@example.com'],
    ['Yuni Kartika', 'yuni@example.com'],
    ['Zaki Maulana', 'zaki@example.com'],

    ['Agus Kurniawan', 'agus@example.com'],
    ['Bella Safitri', 'bella@example.com'],
    ['Chandra Wijaya', 'chandra@example.com'],
    ['Dewi Anggraini', 'dewi@example.com'],
    ['Eko Prasetyo', 'eko@example.com'],
    ['Fitri Handayani', 'fitri@example.com'],
    ['Galih Nugroho', 'galih@example.com'],
    ['Hani Fauziah', 'hani@example.com'],
    ['Ilham Maulana', 'ilham@example.com'],
    ['Jihan Aulia', 'jihan@example.com'],
    ['Kevin Ramadhan', 'kevin@example.com'],
    ['Laila Maharani', 'laila@example.com'],
    ['Miko Saputra', 'miko@example.com'],
    ['Nisa Rahmawati', 'nisa@example.com'],
    ['Oscar Pratama', 'oscar@example.com'],
    ['Putri Amelia', 'putri@example.com'],
    ['Rian Kurnia', 'rian@example.com'],
    ['Sinta Dewi', 'sinta@example.com'],
    ['Teguh Santoso', 'teguh@example.com'],
    ['Ulya Rahma', 'ulya@example.com'],
    ['Vito Aditya', 'vito@example.com'],
    ['Wulan Sari', 'wulan@example.com'],
    ['Yusuf Hakim', 'yusuf@example.com'],
    ['Zahra Nabila', 'zahra@example.com'],
    ['Arif Setiawan', 'arif@example.com'],
    ['Bella Ramadhani', 'bella2@example.com'],
];

$stmt = $db->prepare("
    INSERT INTO users (name, email)
    VALUES (:name, :email)
");

foreach ($users as [$name, $email]) {
    $stmt->execute([
        ':name' => $name,
        ':email' => $email
    ]);
}

echo count($users) . " user berhasil ditambahkan.\n";