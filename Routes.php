<?php
// app/Config/Routes.php

// Mendefinisikan rute untuk halaman login
$routes->get('/login', 'Auth::login'); // Menangani request GET untuk halaman login
$routes->post('/login', 'Auth::login'); // Menangani request POST untuk proses login

// Mendefinisikan rute untuk halaman registrasi
$routes->get('/register', 'Auth::register'); // Menangani request GET untuk halaman registrasi
$routes->post('/register', 'Auth::register'); // Menangani request POST untuk proses registrasi

// Mendefinisikan rute untuk proses logout
$routes->get('/logout', 'Auth::logout'); // Menangani request GET untuk proses logout

// Mendefinisikan rute untuk halaman tugas
$routes->get('/tugas', 'Tugas::index'); // Menangani request GET untuk menampilkan daftar tugas
$routes->get('/tugas/tambah', 'Tugas::tambah'); // Menangani request GET untuk halaman tambah tugas
$routes->post('/tugas/tambah', 'Tugas::tambah'); // Menangani request POST untuk proses tambah tugas
$routes->get('/tugas/edit/(:num)', 'Tugas::edit/$1'); // Menangani request GET untuk halaman edit tugas berdasarkan ID
$routes->post('/tugas/edit/(:num)', 'Tugas::edit/$1'); // Menangani request POST untuk proses edit tugas berdasarkan ID
$routes->get('/tugas/hapus/(:num)', 'Tugas::hapus/$1'); // Menangani request GET untuk proses hapus tugas berdasarkan ID
