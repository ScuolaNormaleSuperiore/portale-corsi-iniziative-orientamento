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
	(9,'png',NULL,NULL,0,'App\\Models\\News',1,'2024-11-05 14:34:28','2024-11-05 14:34:28',1,1),
	(10,'png',NULL,NULL,0,'App\\Models\\News',2,'2024-11-05 14:35:05','2024-11-05 14:35:05',1,1),
	(11,'png',NULL,NULL,0,'App\\Models\\News',3,'2024-11-05 14:35:28','2024-11-05 14:35:28',1,1),
	(12,'png',NULL,NULL,0,'App\\Models\\News',4,'2024-11-05 14:35:50','2024-11-05 14:35:50',1,1),
	(13,'png',NULL,NULL,0,'App\\Models\\Evento',1,'2024-11-05 14:39:18','2024-11-05 14:39:18',1,1),
	(14,'png',NULL,NULL,0,'App\\Models\\Evento',2,'2024-11-05 14:39:59','2024-11-05 14:39:59',1,1),
	(15,'png',NULL,NULL,0,'App\\Models\\Evento',3,'2024-11-05 14:40:32','2024-11-05 14:40:32',1,1),
	(16,'png',NULL,NULL,0,'App\\Models\\StudenteOrientamento',1,'2024-12-16 11:41:56','2024-12-16 11:41:56',1,1),
	(17,'png',NULL,NULL,0,'App\\Models\\StudenteOrientamento',2,'2024-12-16 11:42:22','2024-12-16 11:42:22',1,1),
	(18,'png',NULL,NULL,0,'App\\Models\\StudenteOrientamento',3,'2024-12-16 11:42:52','2024-12-16 11:42:52',1,1),
	(19,'png',NULL,NULL,0,'App\\Models\\StudenteOrientamento',4,'2024-12-16 11:43:15','2024-12-16 11:43:15',1,1),
	(20,'png',NULL,NULL,0,'App\\Models\\StudenteOrientamento',5,'2024-12-16 11:43:37','2024-12-16 11:43:37',1,1),
	(21,'png',NULL,NULL,0,'App\\Models\\StudenteOrientamento',6,'2024-12-16 11:43:58','2024-12-16 11:43:58',1,1);

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


LOCK TABLES `studenti_orientamento` WRITE;
/*!40000 ALTER TABLE `studenti_orientamento` DISABLE KEYS */;

INSERT INTO `studenti_orientamento` (`id`, `materia_id`, `nome`, `cognome`, `descrizione_it`, `link`, `attivo`, `created_at`, `updated_at`, `created_by`, `updated_by`)
VALUES
	(1,1,'Alessia','Conti','<p>Ciao! Sono Alessia e studio Storia dell\'Arte alla Normale. Sono appassionata di arte rinascimentale e contemporanea, e qui ho trovato l\'ambiente ideale per esplorare l\'evoluzione culturale delle arti visive. Se hai curiosità su cosa significhi studiare Storia dell\'Arte alla Normale o vuoi saperne di più sui progetti e le attività in cui sono coinvolta, sarò felice di raccontartelo!</p>','https://www.eventbrite.it/e/biglietti-scuola-aperta-al-majorana-di-capannori-1044264963617?aff=ebdssbdestsearch&_gl=1*su46yj*_up*MQ..*_ga*MTIwMzkwNDIxMC4xNzM0MzQ1NDg2*_ga_TQVES5V6SH*MTczNDM0NTQ4NS4xLjAuMTczNDM0NTQ4NS4wLjAuMA..',1,'2024-12-16 11:41:56','2024-12-16 11:41:56',1,1),
	(2,7,'Lorenzo','Galli','<p>Ciao, sono Lorenzo! Sono appassionato di cultura classica e latino, e qui alla Normale ho potuto immergermi nello studio dei testi antichi e delle loro traduzioni. Se vuoi capire meglio cosa significa studiare Antichistica e scoprire come affrontiamo la traduzione e l’analisi dei testi latini, sono qui per rispondere a tutte le tue domande.</p>','https://www.eventbrite.it/e/biglietti-scuola-aperta-al-majorana-di-capannori-1044264963617?aff=ebdssbdestsearch&_gl=1*su46yj*_up*MQ..*_ga*MTIwMzkwNDIxMC4xNzM0MzQ1NDg2*_ga_TQVES5V6SH*MTczNDM0NTQ4NS4xLjAuMTczNDM0NTQ4NS4wLjAuMA..',1,'2024-12-16 11:42:22','2024-12-16 11:42:22',1,1),
	(3,6,'Chiara','Lombardi','<p>Ciao! Sono Chiara e sto studiando Storia alla Normale. Da sempre mi affascina il passato e il modo in cui influisce sul presente. Qui alla Normale ho avuto l\'opportunità di approfondire i temi storici con un approccio multidisciplinare e critico. Se sei curioso di sapere come si studia Storia in questo contesto unico, sono disponibile a raccontarti il mio percorso.</p>','https://www.eventbrite.it/e/biglietti-scuola-aperta-al-majorana-di-capannori-1044264963617?aff=ebdssbdestsearch&_gl=1*su46yj*_up*MQ..*_ga*MTIwMzkwNDIxMC4xNzM0MzQ1NDg2*_ga_TQVES5V6SH*MTczNDM0NTQ4NS4xLjAuMTczNDM0NTQ4NS4wLjAuMA..',1,'2024-12-16 11:42:52','2024-12-16 11:42:52',1,1),
    (4,3,'Matteo','Ricci','<p>Ciao, sono Matteo! Amo la letteratura italiana e la filologia, e ho scelto la Normale per approfondire lo studio dei testi antichi e le loro interpretazioni. La mia esperienza qui mi ha permesso di vivere la ricerca letteraria a un livello che non immaginavo. Se vuoi conoscere meglio il percorso in Italianistica e capire come funziona lo studio dei testi, sarò lieto di condividere la mia esperienza con te.</p>','https://www.eventbrite.it/e/biglietti-scuola-aperta-al-majorana-di-capannori-1044264963617?aff=ebdssbdestsearch&_gl=1*su46yj*_up*MQ..*_ga*MTIwMzkwNDIxMC4xNzM0MzQ1NDg2*_ga_TQVES5V6SH*MTczNDM0NTQ4NS4xLjAuMTczNDM0NTQ4NS4wLjAuMA..',1,'2024-12-16 11:43:15','2024-12-16 11:43:15',1,1),
    (5,12,'Francesca','De Rosa','<p>Ciao! Sono Francesca e studio Filosofia alla Normale. Amo riflettere sui grandi interrogativi dell’esistenza, sia attraverso la filosofia antica che le questioni contemporanee. Se vuoi sapere come la filosofia viene studiata alla Normale e come la nostra comunità accademica affronta questi temi, sono a disposizione per condividere la mia esperienza.</p>','https://www.eventbrite.it/e/biglietti-scuola-aperta-al-majorana-di-capannori-1044264963617?aff=ebdssbdestsearch&_gl=1*su46yj*_up*MQ..*_ga*MTIwMzkwNDIxMC4xNzM0MzQ1NDg2*_ga_TQVES5V6SH*MTczNDM0NTQ4NS4xLjAuMTczNDM0NTQ4NS4wLjAuMA..',1,'2024-12-16 11:43:37','2024-12-16 11:43:37',1,1),
    (6,3,'Davide','Moretti','<p>Ciao, sono Davide! Studio Antichistica con un focus su Paleografia qui alla Normale. Sono sempre stato affascinato dai testi antichi e dalla scrittura del passato: leggere e decifrare documenti originali è come aprire una finestra su epoche lontane.Se sei interessato a scoprire cosa significhi studiare Paleografia e come affrontiamo il lavoro con i testi antichi, sarò felice di raccontarti la mia esperienza!</p>','https://www.eventbrite.it/e/biglietti-scuola-aperta-al-majorana-di-capannori-1044264963617?aff=ebdssbdestsearch&_gl=1*su46yj*_up*MQ..*_ga*MTIwMzkwNDIxMC4xNzM0MzQ1NDg2*_ga_TQVES5V6SH*MTczNDM0NTQ4NS4xLjAuMTczNDM0NTQ4NS4wLjAuMA..',1,'2024-12-16 11:43:58','2024-12-16 11:43:58',1,1);

/*!40000 ALTER TABLE `studenti_orientamento` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
