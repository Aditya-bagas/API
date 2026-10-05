<?php

$db = new PDO('sqlite:database/database.sqlite');

$db->exec("
    CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        email TEXT NOT NULL UNIQUE
    )
");

echo "Database berhasil dibuat.";