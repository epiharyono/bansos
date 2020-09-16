<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

- NIK
- KK


- sembako senilai

dropkan blt

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

## License
- docker images => untuk cek image docker
- docker pull mongo  => download docker image (bisa lihat di hub.docker.com)
- docker container ls --all
- docker container create --name mongoserver1 -p 8080:27017 mongo:4.1
  port 8080 untuk bisa diakses dari luar container
  port 27017 adalah port default mongodb pada container
  mongo:4.1 itu adalah images dari docker

- docker container create --name mongoserver2 -p 8181:27017 mongo:4.1
- docker container start mongoserver1 mongoserver2  => untuk menjalankan docker container
- docker container stop mongoserver1 => untuk stop docker container
- docker container rm mongoserver1 mongoserver2
- docker image rm mongo => untuk menghapus image docker




CREATE TABLE `ta_penerima` (
  `id` int(11) NOT NULL,
  `id_bansos` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `nik` varchar(25) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `keterangan` text,
  `blt` double NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ta_penerima`
--
ALTER TABLE `ta_penerima`
  ADD KEY `ta_penerima_idbansos` (`id_bansos`),
  ADD KEY `ta_penerima_nik` (`nik`),
  ADD KEY `ta_penerima_jenis` (`id_jenis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ta_penerima`
--
ALTER TABLE `ta_penerima`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ta_penerima`
--
ALTER TABLE `ta_penerima`
  ADD CONSTRAINT `ta_penerima_idbansos` FOREIGN KEY (`id_bansos`) REFERENCES `ta_bansos` (`id`),
  ADD CONSTRAINT `ta_penerima_jenis` FOREIGN KEY (`id_jenis`) REFERENCES `ref_jenis` (`id`),
  ADD CONSTRAINT `ta_penerima_nik` FOREIGN KEY (`nik`) REFERENCES `ta_penduduk` (`nik`);
COMMIT;



CREATE TABLE `ta_penerima` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nik` varchar(25) NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `id_prov` char(2) NOT NULL,
  `id_kab` int(11) NOT NULL,
  `id_kec` int(11) NOT NULL,
  `id_desa` char(10) NOT NULL,
  `nm_prov` varchar(255) NOT NULL,
  `nm_kab` varchar(255) NOT NULL,
  `nm_kec` varchar(255) NOT NULL,
  `nm_desa` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ta_penerima`
--
-- Indexes for dumped tables
--

--
-- Indexes for table `ta_penerima`
--
ALTER TABLE `ta_penerima`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ta_penerima`
--
ALTER TABLE `ta_penerima`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;


ALTER TABLE `ta_penerima` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `alamat`, ADD `created_by` VARCHAR(255) NOT NULL AFTER `created_at`, ADD `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_by`, ADD `updated_by` VARCHAR(255) NOT NULL AFTER `updated_at`;



The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
