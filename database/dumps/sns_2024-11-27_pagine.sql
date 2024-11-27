# ************************************************************
# Sequel Ace SQL dump
# Versione 20067
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 8.0.27)
# Database: sns
# Tempo Di Generazione: 2024-11-27 13:53:23 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump della tabella eventi
# ------------------------------------------------------------

LOCK TABLES `eventi` WRITE;
/*!40000 ALTER TABLE `eventi` DISABLE KEYS */;

INSERT INTO `eventi` (`id`, `data`, `orario`, `titolo_it`, `sottotitolo_it`, `slug_it`, `data_fine`, `luogo`, `attivo`, `evidenza`, `created_at`, `updated_at`, `created_by`, `updated_by`)
VALUES
	(1,'2024-11-26','18:30','La Torre della fame. Dante Alighieri, Ugolino della Gherardesca e i luoghi di un mito',NULL,'la-torre-della-fame-dante-alighieri-ugolino-della-gherardesca-e-i-luoghi-di-un-mito','2024-11-28','Scuola Normale di Pisa',1,1,'2024-11-05 14:39:18','2024-11-05 14:39:18',1,1),
	(2,'2024-11-13',NULL,'L\'Arte della Natura',NULL,'larte-della-natura',NULL,'Giardino Botanico di Pisa',1,2,'2024-11-05 14:39:59','2024-11-05 14:39:59',1,1),
	(3,'2024-12-09',NULL,'RICCARDO ACCIARINO, clarinetti ed elettronica',NULL,'riccardo-acciarino-clarinetti-ed-elettronica',NULL,'Piazza dei Cavalieri di Pisa',1,3,'2024-11-05 14:40:32','2024-11-05 14:40:32',1,1);

/*!40000 ALTER TABLE `eventi` ENABLE KEYS */;
UNLOCK TABLES;


# Dump della tabella fotos
# ------------------------------------------------------------

LOCK TABLES `fotos` WRITE;
/*!40000 ALTER TABLE `fotos` DISABLE KEYS */;

INSERT INTO `fotos` (`id`, `ext`, `nome`, `descrizione`, `ordine`, `mediable_type`, `mediable_id`, `created_at`, `updated_at`, `created_by`, `updated_by`)
VALUES
	(1,'jpeg',NULL,NULL,0,'App\\Models\\PaginaOrientamento',1,'2024-10-30 19:10:57','2024-10-30 19:10:57',1,1),
	(2,'jpeg',NULL,NULL,0,'App\\Models\\StudenteOrientamento',2,'2024-10-31 16:47:36','2024-10-31 16:47:36',1,1),
	(3,'png',NULL,NULL,0,'App\\Models\\StudenteOrientamento',3,'2024-11-05 14:24:12','2024-11-05 14:24:12',1,1),
	(4,'png',NULL,NULL,0,'App\\Models\\StudenteOrientamento',4,'2024-11-05 14:24:44','2024-11-05 14:24:44',1,1),
	(5,'png',NULL,NULL,0,'App\\Models\\StudenteOrientamento',5,'2024-11-05 14:25:10','2024-11-05 14:25:10',1,1),
	(6,'png',NULL,NULL,0,'App\\Models\\StudenteOrientamento',6,'2024-11-05 14:25:35','2024-11-05 14:25:35',1,1),
	(7,'png',NULL,NULL,0,'App\\Models\\StudenteOrientamento',7,'2024-11-05 14:26:03','2024-11-05 14:26:03',1,1),
	(8,'png',NULL,NULL,0,'App\\Models\\StudenteOrientamento',8,'2024-11-05 14:26:25','2024-11-05 14:26:25',1,1),
	(9,'png',NULL,NULL,0,'App\\Models\\News',1,'2024-11-05 14:34:28','2024-11-05 14:34:28',1,1),
	(10,'png',NULL,NULL,0,'App\\Models\\News',2,'2024-11-05 14:35:05','2024-11-05 14:35:05',1,1),
	(11,'png',NULL,NULL,0,'App\\Models\\News',3,'2024-11-05 14:35:28','2024-11-05 14:35:28',1,1),
	(12,'png',NULL,NULL,0,'App\\Models\\News',4,'2024-11-05 14:35:50','2024-11-05 14:35:50',1,1),
	(13,'png',NULL,NULL,0,'App\\Models\\Evento',1,'2024-11-05 14:39:18','2024-11-05 14:39:18',1,1),
	(14,'png',NULL,NULL,0,'App\\Models\\Evento',2,'2024-11-05 14:39:59','2024-11-05 14:39:59',1,1),
	(15,'png',NULL,NULL,0,'App\\Models\\Evento',3,'2024-11-05 14:40:32','2024-11-05 14:40:32',1,1);

/*!40000 ALTER TABLE `fotos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump della tabella news
# ------------------------------------------------------------

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;

INSERT INTO `news` (`id`, `data`, `titolo_it`, `sottotitolo_it`, `slug_it`, `evidenza`, `attivo`, `created_at`, `updated_at`, `created_by`, `updated_by`)
VALUES
	(1,'2024-10-01','Luigi Ambrosio, Prolusione di inizio anno accademico 2024/2025','il merito come criterio di giudizio, la ricerca come strumento di crescita','luigi-ambrosio-prolusione-di-inizio-anno-accademico-20242025',1,1,'2024-11-05 14:34:28','2024-11-05 14:34:28',1,1),
	(2,'2024-10-01','Scuola Normale, cerimonia di inaugurazione dell’anno accademico',NULL,'scuola-normale-cerimonia-di-inaugurazione-dellanno-accademico',2,1,'2024-11-05 14:35:05','2024-11-05 14:35:05',1,1),
	(3,'2024-11-01','Scuola Normale, accoglienza a 76 nuovi allieve e allievi del corso ordinario',NULL,'scuola-normale-accoglienza-a-76-nuovi-allieve-e-allievi-del-corso-ordinario',3,1,'2024-11-05 14:35:28','2024-11-05 14:35:28',1,1),
	(4,'2024-11-01','La Normale aderisce all’iniziativa Bike to work, per una mobilità sostenibile',NULL,'la-normale-aderisce-alliniziativa-bike-to-work-per-una-mobilita-sostenibile',4,1,'2024-11-05 14:35:50','2024-11-05 14:35:50',1,1),
	(5,'2024-11-03','2 - La Normale aderisce all’iniziativa Bike to work, per una mobilità sostenibile',NULL,'2-la-normale-aderisce-alliniziativa-bike-to-work-per-una-mobilita-sostenibile',4,1,'2024-11-05 14:35:50','2024-11-05 14:35:50',1,1),
	(6,'2024-10-03','3 - La Normale aderisce all’iniziativa Bike to work, per una mobilità sostenibile',NULL,'3-la-normale-aderisce-alliniziativa-bike-to-work-per-una-mobilita-sostenibile',4,1,'2024-11-05 14:35:50','2024-11-05 14:35:50',1,1),
	(7,'2024-10-08','4 - La Normale aderisce all’iniziativa Bike to work, per una mobilità sostenibile',NULL,'4-la-normale-aderisce-alliniziativa-bike-to-work-per-una-mobilita-sostenibile',4,1,'2024-11-05 14:35:50','2024-11-05 14:35:50',1,1),
	(8,'2024-10-31','5 - fdsdasds','dasdasdasdasdsa','5-sdasdasdads',NULL,1,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;


# Dump della tabella pagine
# ------------------------------------------------------------

LOCK TABLES `pagine` WRITE;
/*!40000 ALTER TABLE `pagine` DISABLE KEYS */;

INSERT INTO `pagine` (`id`, `titolo_it`, `sottotitolo_it`, `ordine`, `attivo`, `homepage`, `slug_it`, `tipo`, `created_at`, `updated_at`, `created_by`, `updated_by`)
VALUES
	(1,'Scienziate di domani',NULL,1,1,1,'scienziate-di-domani','orientamento','2024-10-30 19:10:57','2024-10-30 19:10:57',1,1),
	(2,'Alla Normale anche tu',NULL,2,1,1,'alla-normale-anche-tu','orientamento','2024-10-30 19:10:57','2024-11-05 14:41:12',1,1),
	(3,'La Normale a Scuola',NULL,3,1,1,'la-normale-a-scuola','orientamento','2024-10-30 19:10:57','2024-11-05 14:41:25',1,1),
	(4,'Gli stage della Normale',NULL,4,1,1,'gli-stage-della-normale','orientamento','2024-10-30 19:10:57','2024-11-05 14:41:45',1,1),
	(5,'Contenuti dei corsi di orientamento',NULL,5,1,1,'contenuti-dei-corsi-di-orientamento','orientamento','2024-11-05 14:51:06','2024-11-05 14:51:06',1,1),
	(7,'Scopri i luoghi della Normale',NULL,6,1,1,'scopri-i-luoghi-della-normale','orientamento','2024-11-05 14:52:16','2024-11-05 14:52:16',1,1),
	(8,'Percorsi per le competenze trasversali  e per l’orientamento',NULL,7,1,0,'percorsi-per-le-competenze-trasversali-e-per-lorientamento','orientamento','2024-11-05 14:53:07','2024-11-05 14:53:07',1,1),
	(10,'Media policy',NULL,NULL,1,0,'media-policy','standard','2024-10-30 19:10:57','2024-11-15 17:04:19',1,1),
	(11,'Privacy policy',NULL,NULL,1,0,'privacy-policy','standard','2024-10-30 19:10:57','2024-11-15 17:04:19',1,1),
	(12,'Note legali',NULL,1,1,0,'note-legali','standard','2024-10-30 19:10:57','2024-10-30 19:10:57',1,1);

/*!40000 ALTER TABLE `pagine` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
