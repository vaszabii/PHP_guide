-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2020. Jún 10. 14:20
-- Kiszolgáló verziója: 5.5.62-0+deb8u1
-- PHP verzió: 7.1.33-15+0~20200419.36+debian8~1.gbp2384b3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `vizsga`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `album`
--

CREATE TABLE `album` (
  `id` char(4) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'Zenei album egyedi azonosítója',
  `cim` varchar(255) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'Az album címe',
  `eloado_id` char(4) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'Az album előadója',
  `kiadas_eve` year(4) NOT NULL COMMENT 'Az album kiadásának éve',
  `kis_borito` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL COMMENT 'Album borító kis méretben (fájlnév, vagy NULL, ha nem érhető el)',
  `nagy_borito` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL COMMENT 'Album borító nagy méretben (fájlnév, vagy NULL, ha nem érhető el)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Zenei albumok adatai';

--
-- A tábla adatainak kiíratása `album`
--

INSERT INTO `album` (`id`, `cim`, `eloado_id`, `kiadas_eve`, `kis_borito`, `nagy_borito`) VALUES
('it', 'Indiántánc', 'ka', 1995, 'it_kicsi.jpg', 'it_nagy.jpg'),
('nh', 'Naphoz holddal', 'kpb', 1991, 'nh_kicsi.jpg', NULL),
('ut', 'Új törvény', 'ka', 2002, NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `dal`
--

CREATE TABLE `dal` (
  `id` int(11) NOT NULL COMMENT 'Dal egyedi azonosítója',
  `album_id` char(4) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'Az album azonosítója, amire a dal rákerült',
  `sorszam` int(11) NOT NULL COMMENT 'A dal sorszáma az albumon',
  `cim` varchar(255) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'A dal címe',
  `hossz` time NOT NULL COMMENT 'A dal hossza',
  `szoveg` text COLLATE utf8_hungarian_ci COMMENT 'Dalszöveg, ha van'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `dal`
--

INSERT INTO `dal` (`id`, `album_id`, `sorszam`, `cim`, `hossz`, `szoveg`) VALUES
(1, 'nh', 1, 'Lefekszem a hóba', '00:02:20', '1. Mintha lenne más\r\nCsak annyit álmodok\r\nZárom ujjaim\r\nA fényes hold körül\r\nLélek láboson\r\nA fedő megremeg\r\nNem kell használni\r\nAmit csak lehet\r\n\r\n2. Hétfő megfeszül\r\nVasárnap ellazul\r\nNincsen több hibád\r\nTv-d is megjavul\r\nÖrökre itt maradsz\r\nHogy ne zavarjalak\r\nFelhős földemen\r\nA fényes ég alatt'),
(2, 'nh', 2, 'A 60-as évek vége', '00:03:15', '1. Turkálj a szekrénybe, nézd apu bárányfelhőit!\r\nÓ, telihold, pompás időkre emlékezem\r\n\r\nR. Egy hatalmas szendvicset ettünk apa felhőivel\r\nJó, hogy vége a 60-as éveknek, és nem jön újra el\r\n\r\n2. Turkálj a szekrénybe, nézz anyu, apu után\r\nJó, hogy vége van ennek az évnek, és más jön ez után'),
(3, 'nh', 3, 'Húsrágó hídverő', '00:03:01', '1. És most nincs más, hát jöjj elő\r\nHúsrágó, hídverő, félkarral ölelő\r\nItt elveszett este egy bogár a testbe\r\nHogyha új trükköt nem csinálsz\r\nHolnap kijön egy óriás\r\nTéged megesz, engem elás\r\nÉs nem csinál semmi mást\r\nEz a k**** nagy óriás\r\n\r\n2. Mindentől messze, a szívhez közel\r\nCsinálj csodát, én meg elhiszem\r\nHogy kell egy rendszer, ami nem mozog\r\nÉs megígérte Anyu is, hogy megkapod\r\nMert a karod csak egy holt ág, vágd el és szaladj\r\nEgy vonalban vannak most a szíved meg az agyad\r\nHúsrágó, hídverő, ne sírj a versen\r\nÉn idáig jöttem, most dolgozzon a lelkem'),
(4, 'nh', 4, 'Tejjel kifli', '00:04:38', '1. Reggel lett, a rádióban esik\r\nTejjel kifli, ha megyek a boltba\r\nLenyeltem egy kétforintost\r\nHogy telefonáljak a magányomba\r\n\r\n2. A rádiómból egy fa nőtt ki este\r\nEgész éjjel néztem a fát\r\nÉs hallgattam, hogy ne nehezítsem\r\nA bemondó távoli halálát\r\n\r\n3. Lekvárt ettem, ragasszon össze\r\nKéső őszi lekvárod az ingemen\r\nMézet ettem, ragasszon össze\r\nMézemet lássad rajta mindenen'),
(5, 'nh', 5, 'Macska', '00:03:56', ' 1. Macska száguld a felhő szélén\r\nFényes szempár kiséri útját\r\nÁllok a földön, nézem az eget\r\nVágyom rá, hogy távol legyek\r\n\r\nR1. Nézd, hogy lóg le a lábam a felhődről,\r\nNézd, hogy lóg le a lábam a felhődről!\r\n\r\n2. Nadrágja sárga, ő a fal mellett áll\r\nKorom borítja űrhajóját\r\nFekete tokból vitorlát bontva\r\nVágyom rá, hogy távol legyek\r\n\r\nR2. Nézd, hogy lóg le a lábam a felhőről,\r\nNézd, hogy lóg le a lábam a felhődről!\r\n\r\n1.\r\n\r\nR1'),
(6, 'nh', 6, 'Kicsi csillag', '00:02:40', '1. Jön le a csillag, kívánom\r\nLeér, elfekszik az ágyon\r\nKimegyek a kertbe, ha van seb az égen\r\nNem kell minden áron\r\n\r\nR. Mert ha nincs nő, jó a csillag\r\nAmit egy másik rendszer itt hagy\r\nTedd ide kis puha cuccaidat\r\nMert vége van ennek nagyon kicsi csillag\r\n\r\n2. Ma nem oldlak meg probléma\r\nHagylak feküdni az ágyon\r\nGyilkold csak egyedül fekve azt\r\nAmi belülről kisüt a hájon\r\n\r\nR'),
(7, 'nh', 7, 'Barlangban dobolok', '00:02:49', '1. Barlangban dobolok, vörös a szemem\r\nKinézek közbe a nap lement-e\r\nVörös szemembe zöld fát éget a hamu\r\nRugdosom reggelente\r\n\r\n2. És ettől eddig, attól addig\r\nUgyanolyan a másik oldal\r\nTélen banán, nyáron meleg\r\nÉjszaka van, napozz Holddal!\r\n\r\n3. Reggeliztél, álmodoztál\r\nTélen banán, nyáron meleg\r\nHomokba dugtad az ujjad:\r\nLegyen egy olajlelőhelyed.'),
(8, 'nh', 8, 'Őrjárat', '00:02:27', '1. Bejött a szobába, bejött a szobába az őrjárat,\r\nLáttam a hátukon, a hátukon láttam a vödröket.\r\n\r\n2. Bejött a híd alá, bejött a híd alá a folyó,\r\nLáttam a lányt, láttam a lányt, és tegnap volt.'),
(9, 'nh', 9, 'Forradalmár', '00:03:08', '1. Kilöktek az útra, az autó rám dudált\r\nNéztem, mint alma nélkül a szelíd almafák\r\nA házak falaira puskát rajzoltam\r\nAz egyetlen forradalmár vagyok a városban\r\n\r\n2. Most puska a vállamon, a lovam felnyerít\r\nEsténként eszem meg a kihűlt reggelit\r\nSzeretem a nőket, de ők engem jobban\r\nAz egyetlen forradalmár vagyok a városban\r\n\r\n3. S mivel forradalmár minden városba kell\r\nNekem meg ez a város nagyon megfelel\r\nAz autók elé, az útra vetem magam\r\nAz egyetlen forradalmár vagyok a városban '),
(10, 'nh', 10, 'A vadnyugat története indián szemmel', '00:02:53', 'Látod, a földből kijön egy madár\r\nNagy mozdulat, szarból legenda\r\nMásnapra éretlen zöld tollait\r\nSimítom hátra a hajamba\r\n\r\n||: Egyedül a szobában, ugyanúgy, mint régen. :||\r\nEgyedül a szobában, ugyanúgy, mint régen.\r\nEgyedül a szobában ooooooo'),
(11, 'nh', 11, 'Holdutazás', '00:03:12', '1. Írd fel, mi kell a Holdról neked\r\nKinőtted minden kabátodat\r\nHazamentél, mikor táncolni kezdtél\r\nA szemceruzáddal húzd ki magad\r\n\r\n2. Ha kijön a nap, te árnyékot látsz\r\nDe a te űrhajód sem a türelem tolja\r\nTeát csináltál a környező fákból\r\nS azzal jársz fel a Földről a Holdra\r\n\r\n3. Megeszi a lepkét a káposztalepkét\r\nEz a hajnali négykor induló tigris\r\nA járdaszegélyen egyensúlyoz\r\nÉs nem lép le, mert talán figyeled most is\r\n\r\n4. Ez itt egy éjjel működő ösztön\r\nHogy felnézel, és mennél fel\r\nDe majd lehoznak a hegyimentők\r\nHogy nehogy a Holdon ébredj fel '),
(12, 'nh', 12, 'Szőkített nő', '00:04:26', '1. Egyszer egy szőkített nő kifogott egy ebihalat\r\nA hideg nagyvárosban a hidak alatt\r\nA szívkirály fázott, de nem beszélt\r\nCsak csodálkozott, hogy a földre ért\r\n\r\n2. És jó itt, mondta a riportban\r\nKereste a nőt, hogy őt is bemondja\r\nAz meg állt szőkén a hidak alatt\r\nS csak nézte a többi ebihalat\r\n\r\nR. Mert itt a földön él, és nem beszél velem se\r\nKitalálhatom, hogy mit csinál\r\nA háza nagy, a férje béka\r\nPuszilja persze, de nem király\r\n\r\n3. És most otthon ül, s hallgatja míg sötét lesz\r\nTöri a sósat a tv-hez\r\nLehet, hogy jó lett volna talán\r\nÉs most már elég, hogyha szól egy szomorú szám\r\n\r\nR.'),
(13, 'nh', 13, 'Naphoz holddal', '00:02:28', '1. Mintha lenne más\r\nCsak annyit álmodok\r\nZárom ujjaim\r\nA fényes hold körül\r\nLélek láboson\r\nA fedő megremeg\r\nNem kell használni\r\nAmit csak lehet\r\n\r\n2. Hétfő megfeszül\r\nVasárnap ellazul\r\nNincsen több hibád\r\nTv-d is megjavul\r\nÖrökre itt maradsz\r\nHogy ne zavarjalak\r\nFelhős földemen\r\nA fényes ég alatt'),
(14, 'it', 1, 'Erő és alázat', '00:03:52', 'Ugye mondtam, hogy eljövök, ha hívsz,\r\nCsak bízz!\r\nLelked ajtaját kinyitom lassan!\r\n\r\nHittem azt is, hogy nem felejtesz el,\r\nÉs ha kell, segítek rajtad,\r\nSegítesz rajtam, ó, barát a bajban!\r\n\r\nBarátom, a válladon bánat ül,\r\nDe sokan vagyunk egyedül!\r\nHiába pusztul az indián törzs,\r\nVagy szakad a lánc...\r\n\r\nHangodban ezer év csendje ég,\r\nÓ, ne hagyd abba még!\r\nVan, aki tudja, hogy ez vallás,\r\nEz mítosz, ez végtelen tánc!\r\n\r\nRészeg az idő, számtalan jellel\r\nÜzen a mámor.\r\nÉrzem, hogy itt vagy, magamba nézek,\r\nÉs meglellek bárhol!\r\n\r\nÓ, erő és alázat\r\nTáncol velem,\r\nÓ, erő és alázat,\r\nEz az én ünnepem!\r\n\r\nÜzenj, mert az Isten néz,\r\nÉs tudod, hogy az üzenet a dolgod.\r\nÜzenj, tudd, hogy merre mész,\r\nMert enélkül sose lehetsz boldog!\r\n\r\nÓ, erő és alázat\r\nTáncol velem,\r\nÓ, erő és alázat,\r\nEz az én ünnepem, igen!\r\n\r\nÓ, erő és alázat\r\nTáncol velünk,\r\nÓ, erő és alázat,\r\nEz a mi ünnepünk, gyerünk!'),
(15, 'it', 2, 'Esőkirály', '00:04:53', 'Ha nincsen semmi szép abban, amit vársz,\r\nHa annak sem örülsz, hogy hazatalálsz,\r\nHa az éjnek ércfalát fényszóró fúrja át,\r\nÉs dobol a négy kerék, mind azt súgja: menni még,\r\nHa túl sok szennyet látsz, és megtisztulni vágysz,\r\nElmossa bánatod az Esőkirály.\r\n\r\nEsőkirály, hatalmad vára áll,\r\nFelhőd alatt táncolok, Esőkirály.\r\nFölém borul, úgy tornyosul,\r\nFelnézek rád jámborul,\r\nKönnyeidben fürdöm, Esőkirály.\r\n\r\nEsőkirály, hatalmad vára áll,\r\nFelhőd alatt táncolok, Esőkirály.\r\nFölém borul, úgy tornyosul,\r\nFelnézek rád jámborul,\r\nKönnyeidben fürdetsz Esőkirály.\r\n\r\nHa nincsen semmi szép abban, amit vársz,\r\nHa annak sem örülsz, hogy hazatalálsz,\r\nHa az éjnek ércfalát fényszóró fúrja át,\r\nÉs dobol a négy kerék, mind azt súgja: menni még.\r\nHa túl sok szennyet látsz, és megtisztulni vágysz,\r\nElmossa bánatod az Esőkirály.\r\n\r\nEsőkirály, hatalmad vára áll,\r\nFelhőd alatt táncolok, Esőkirály.\r\nFölém borul, úgy tornyosul,\r\nFelnézek rád jámborul,\r\nKönnyeidben fürdetsz, Esőkirály,\r\nEsőkirály!!!'),
(16, 'it', 3, 'Nevess magadon', '00:03:22', 'Én hallgatlak téged,\r\nVagy Te hallgatsz engem?\r\nBennem laksz régen,\r\nA házad a testem.\r\n\r\nMegismerlek a csendedből,\r\nÉs hallok én is titkos hangokat.\r\nÖrülök neked, különleges vagy,\r\nMegszülted bennem a saját dalodat,\r\n\r\nMegszülted bennem a saját dalodat!\r\n\r\nNevess magadon,\r\nLebegj csak szabadon!\r\nHa szeretni akarsz,\r\nNincsen késő még.\r\nNevess magadon,\r\nLebegj csak szabadon,\r\nÉrezd Te is!\r\n\r\nSámántáncomba beleremegnek\r\nA hegyek, a völgyek, a csillagok,\r\nVarázsszavakkal megidézlek téged,\r\nJöhetsz bármikor, én mindig kész vagyok.\r\n\r\nSzavaid vezetnek minden utamon,\r\nJeled rajtam ég, láthatatlanul.\r\nMost már értem, mit is mondasz,\r\nTanítvány vagyok, aki nehezen tanul,\r\n\r\nTanítvány vagyok, aki nehezen tanul!\r\n\r\nNevess magadon,\r\nLebegj csak szabadon!\r\nHa szeretni akarsz,\r\nNincsen késő még.\r\nNevess magadon,\r\nLebegj csak szabadon,\r\nÉrezd Te is\r\nA békesség erejét!'),
(17, 'it', 4, 'Tavaszi mohikán', '00:03:01', 'Égi jelnek földi mása.\r\nA Nappal vagyok egy,\r\nSólymok, farkasok unokája,\r\nEmber-állat, furcsa elegy,\r\nNapfivér, széltestvér, tavaszi mohikán,\r\nSzenvedély-útvesztő nyílik a lábam nyomán.\r\n\r\nÉs a hangok, a hangok, szavak és csendek\r\nÜldöznek örökkön és körém térdepelnek.\r\nÉn neked akarok énekelni,\r\nÉn így vagyok szabad\r\nAz ölelés is áttüzesedhet\r\nVigyázz: gazdája mostantól Te vagy!\r\n\r\nÁtvirrasztott évezredek,\r\nÉs hatalmas csönd után\r\nÉn mindig eljövök, hogy újra láss,\r\nÉn, a titkos örömök kincstárnoka,\r\nÉn, a tavaszi mohikán,\r\nÉn mindig eljövök, hogy újra láss.\r\n\r\nSzemed íriszén magunkat látom,\r\nFénylő tükör a döbbenet.\r\nSok életet meguntam már,\r\nDe most örülök neki, hogy itt lehetek.\r\nTúl a bűnön, a megbánáson,\r\nHitem tüzéhez ülök közel,\r\nMellém fekszel és azt se bánom,\r\nHogy úgy alszol el, ahogy megszoktad már\r\nMásvalakivel...'),
(18, 'it', 5, 'Örvény', '00:03:56', 'Tovább nem tudok várni,\r\nMost már megteszi bármi,\r\nAz lesz a veszted,\r\nHogy örvénylik a tested.\r\n\r\nAz alkalom itt van,\r\nHát hódolj be halkan!\r\nSzázezer éve\r\nMindig ez a vége.\r\n\r\nMindegy a színhely,\r\nNem kell, hogy színlelj,\r\nSzeress vagy vess meg,\r\nÉn birtokba veszlek!\r\n\r\nOlvadni kezd most a Hold,\r\nAz arcod a párnán\r\nCsak egy furcsa-furcsa folt.\r\nÓcska kis közhely,\r\nGyönyörű törvény,\r\nHogy a szerelem örvény.\r\n\r\nTovább nem tudok várni,\r\nMost már megteszi bármi,\r\nAz lesz a veszted,\r\nHogy örvénylik a tested.\r\n\r\nLátod, nálam a fegyver,\r\nDe reszketned nem kell,\r\nMert ez csak gyönyört fakaszt,\r\nHát húzd meg a ravaszt,\r\nUgye érzed a tavaszt?!?\r\n\r\nOlvadni kezd most a Hold,\r\nAz arcod a párnán\r\nCsak egy furcsa-furcsa folt.\r\nÓcska kis közhely,\r\nGyönyörű törvény,\r\nHogy a szerelem örvény.'),
(19, 'it', 6, 'Ez a miénk', '00:03:45', 'Egy tanú a testben, örökké lesben,\r\nEz a miénk!\r\nVégtelen táncot táncolunk ketten,\r\nEz a miénk!\r\nCsak a Tiéd és az enyém!\r\nSzentélyek csöndje és keserű, lusta kéj,\r\nEz a miénk!\r\nEgy szemvillanásnyit szikrázó szenvedély,\r\nEz a miénk!\r\nCsak a Tiéd és az enyém!\r\n\r\nAz éjjel tüzében dereng egy szellem-arc,\r\nVigyázz, nehogy elriaszd!\r\nDe ha a szemébe nézel, belehalsz!\r\nAz éjjel tüzében dereng egy szellem-arc,\r\nVigyázz, nehogy elriaszd!\r\nDe ha a szemébe nézel, belehalsz!\r\n\r\nA láz, hogyha éget a láng, hogyha ébred,\r\nEz a miénk!\r\nMegérint engem, megérint Téged,\r\nEz a miénk!\r\nCsak a Tiéd és az enyém!\r\n\r\nAz éjjel tüzében dereng egy szellem-arc,\r\nVigyázz, nehogy elriaszd!\r\nDe ha a szemébe nézel, belehalsz!\r\nAz éjjel tüzében dereng egy szellem-arc,\r\nVigyázz, nehogy elriaszd!\r\nDe ha a szemébe nézel, belehalsz!\r\n\r\nEz a miénk!\r\nA dalok tükrében derengő szellem-arc,\r\nEz a miénk!\r\nCsak a Tiéd és az enyém!'),
(20, 'it', 7, 'Áldozz fel', '00:03:25', 'Jobb lesz, ha már nem is akarsz mást,\r\nCsak a csendet és igazságot.\r\nKidobhatsz minden ócska kacatot,\r\nA zajokat és a hazugságot.\r\n\r\nMindent a lázért, a megtisztulásért,\r\nMinden a szóért, bár idegen és hideg,\r\nMindent a dalban kimondott versért,\r\nMindent, akkor is, ha nem éri meg,\r\nÁldozz fel!\r\n\r\nHazugok napja néz le most is Rád,\r\nLépj közelebb, vesd le az álruhád,\r\nÉs táncolj!\r\n\r\nHalálos élet, senkitől sem kérted.\r\nNincs kire nézned, nincs segítség.\r\nAki a bánatnak örül, rajtad nem könyörül,\r\nFájdalmat tűrni kell még.\r\n\r\nMindent a lázért, a megtisztulásért,\r\nMinden a szóért, bár idegen és hideg,\r\nMindent a dalban kimondott versért,\r\nMindent, akkor is, ha nem éri meg,\r\nÁldozz fel!\r\n\r\nHazugok napja néz le most is Rád,\r\nLépj közelebb, vesd le az álruhád,\r\nÉs táncolj!\r\n\r\nMindent a lázért, a megtisztulásért,\r\nMinden a szóért, bár idegen és hideg,\r\nMindent a dalban kimondott versért,\r\nMindent, akkor is, ha nem éri meg,\r\nÁldozz fel!'),
(21, 'it', 8, ' Indiántánc', '00:04:32', 'Tűzből jöttem erre a Földre,\r\nLángok formálták testemet.\r\nÉs a tűz ölel majd magához örökre,\r\nDe addig mindvégig itt leszek.\r\n\r\nKrétajeleket rajzolok a kőre,\r\nKiadnám minden bánatom,\r\nDe jeleimet az eső mossa el,\r\nJutalmam hiába várhatom.\r\n\r\nMert ez egy indiántánc és én elhiszem,\r\nHogy benned is ég az a láng.\r\nLegyen közös a bánat, közös a bűn,\r\nÉs közös a feloldozás!\r\n\r\nFelemás tavaszt szült ez a tél,\r\nA szerelem nélküli hónapok.\r\nVisszavágynak a mennybe most\r\nA földre pottyant angyalok.\r\n\r\nKeserű szavak íze a számban,\r\nCsak a jövő édes, ami nem jön el.\r\nÉn maradok az, aki mindig is voltam,\r\nEgy indián, aki énekel.\r\n\r\n\r\nMert ez egy indiántánc és én elhiszem,\r\nHogy benned is ég az a láng.\r\nLegyen közös a bánat, közös a bűn,\r\nÉs közös a feloldozás!\r\n\r\nÉn tűz vagyok, akkor is, ha nem hiszed,\r\nHát égj velem, vagy ég veled,\r\nReszketve öleld az életed!\r\n\r\n(2x)\r\n\r\nMert ez egy indiántánc és én elhiszem,\r\nHogy benned is ég az a láng.\r\nLegyen közös a bánat, közös a bűn,\r\nÉs közös a feloldozás!'),
(22, 'it', 9, 'Angyali szerető', '00:04:20', 'Mikor a szárnyam helyét\r\nMegtapogattam,\r\nÚjra hinni kezdtem\r\nÓ, az angyalokban.\r\n\r\nÉs most itt van az idő,\r\nTe angyali szerető,\r\nRepülni hív, csábít a levegő,\r\nA jéghideg levegő, (a jéghideg levegő).\r\n\r\nCsak Te meg én,\r\nA szakadék peremén,\r\nDúdolj egy dalt, ez az utolsó perc!\r\nHa nem láttál még,\r\nMost majd rám ismersz.\r\n\r\nA napfény szárnyadra hull\r\nMozdulatlanul,\r\n(Angyali szerető).\r\nA napfény szárnyadra hull,\r\n(Simogat a levegő),\r\nMozdulatlanul.\r\n(Szinte fáj!)\r\n\r\nKörkörös repülés,\r\nVagy körkörös zuhanás?\r\nKell, hogy érts, kell, hogy láss.\r\nJeleket látsz, ahol nincsenek jelek,\r\nHa zuhanni kezdesz,\r\nÉn megfogom a kezed.\r\n\r\n(Angyali szerető),\r\nA napfény szárnyadra hull\r\n(Simogat a levegő)\r\nMozdulatlanul,\r\n(Angyali szerető).\r\nA napfény szárnyadra hull,\r\n(Simogat a levegő),\r\nMozdulatlanul.\r\n(Szinte fáj!)\r\n\r\nKörkörös repülés,\r\nVagy körkörös zuhanás?\r\nKell, hogy érts, kell, hogy láss.\r\nJeleket látsz, ahol nincsenek jelek,\r\nHa zuhanni kezdesz,\r\nÉn megfogom a kezed.\r\nSzakadék fölött mozdulatlan lebegő,\r\nKitárt szárnyú angyali szerető,\r\nJó lesz, ha figyelsz, jó lesz, ha érted,\r\nÉn itt vagyok veled, és szeretlek téged.\r\n\r\nÉn szeretlek Téged!\r\nÉn szeretlek Téged! '),
(23, 'it', 10, 'Mégis jó', '00:03:34', 'Néha úgy múlik napra nap,\r\nHogy a dalok alszanak,\r\nÉs hiába sírsz, hiába vársz,\r\nAz ünnep elmarad,\r\nCsak a magány hangja szól\r\nA homlokod alól,\r\nMégis jó.\r\n\r\nÉn szeretem azt a dalt,\r\nAmit magadról énekelsz.\r\nÖrülnél, ha tudnád,\r\nHogy engem nagyon érdekelsz.\r\nPersze titkolom,\r\nPersze titkolod,\r\nMégis jó.\r\n\r\nIsten, szólj rám, ha vagy,\r\nÉs ha nem vagy, szóljon, ami nincsen.\r\nOlyan csillagos az égbolt,\r\nOlyan végtelen a Minden.\r\nNéha bánat járja át\r\nAz öröm pillanatát,\r\nMégis jó.\r\n\r\nNincs több póz,\r\nNincs több okoskodás.\r\nIgent mond a test,\r\nÉs magasra szökik a láz.\r\nTáncba hív egy dal,\r\nA tüzed lángja mar,\r\nMégis jó.\r\n\r\nIsten, szólj rám, ha vagy,\r\nÉs ha nem vagy, szóljon, ami nincsen.\r\nOlyan csillagos az égbolt,\r\nOlyan végtelen a Minden.\r\nNéha bánat járja át\r\nAz öröm pillanatát,\r\nMégis jó.\r\n\r\nNincs több póz,\r\nNincs több okoskodás.\r\nIgent mond a test,\r\nÉs magasra szökik a láz.\r\nTáncba hív egy dal,\r\nA tüzed lángja mar,\r\nMégis jó.\r\n\r\nIsten, szólj rám, ha vagy,\r\nÉs ha nem vagy, szóljon, ami nincsen.\r\nOlyan csillagos az égbolt,\r\nOlyan végtelen a Minden.\r\nNéha bánat járja át\r\nAz öröm pillanatát,\r\nMégis jó.\r\n\r\nÉn szeretem azt a dalt,\r\nAmit magadról énekelsz.\r\nÖrülnél, ha tudnád,\r\nHogy engem nagyon érdekelsz.\r\nPersze titkolom,\r\nPersze titkolod,\r\nMégis jó.'),
(24, 'it', 11, 'Minden egyszerű dalban', '00:04:43', 'Te életet adtál\r\nFának, virágnak, szónak;\r\nBenned az öröklött öröklét\r\nHarangjai szólnak.\r\n\r\nMosolyom mögé néztél,\r\nÉs bánatot láttál;\r\nBenned magamra leltem,\r\nÉn a tiéd vagyok, mert rám találtál.\r\n\r\nHiszen benne élsz Te\r\nMinden egyszerű dalban,\r\nHiszen velem vagy,\r\nMint egy oltalmazó,\r\nMindenható dallam.\r\n\r\nMost is téged hívlak,\r\nBár hidegnek látszom,\r\nMagamat feszítve hídnak,\r\nA halállal játszom.\r\n\r\nVírus-város, törvény-örvény,\r\nAz ösztön a börtönöm,\r\nDe az áhítat lassan átitat,\r\nS hogy itt lehetek, most megköszönöm.\r\n\r\nHiszen benne élsz Te\r\nMinden egyszerű dalban,\r\nHiszen velem vagy,\r\nMint egy oltalmazó,\r\nMindenható dallam.\r\n\r\n(Olyan, mint egy tündöklő angyal...)\r\n\r\nTükröt tartasz az égnek,\r\nSzabad vagy,\r\nNincsen kitől félned,\r\nCsak magad vagy.\r\n\r\nHiszen benne élsz Te\r\nMinden egyszerű dalban,\r\nHiszen velem vagy,\r\nMint egy oltalmazó,\r\nMindenható dallam'),
(25, 'it', 12, 'Az utolsó levél', '00:04:04', 'Ez az utolsó levél; álmok között\r\nSzülték bennem a csillagok.\r\nA remény belőlem elköltözött,\r\nNem is jöhetnek jobb napok.\r\n\r\nEz egy utolsó levél, egy meg nem írt,\r\nEgy befelé kiáltó pillanat.\r\nNem szántja toll a jó papírt,\r\nSzememben lángok vallanak.\r\n\r\nSzép vagy, és nem csak fénytelen,\r\nSugártalan büszkeség,\r\nDe másnak jele van testeden,\r\nMegijednél, ha értenéd.\r\n\r\nVárj!\r\nTudod, hogy hiába menekülsz,\r\nHiszen akármerre is mennél,\r\nMindig utolér az utolsó levél.\r\n\r\nVárj!\r\nTudod, hogy hiába menekülsz,\r\nHiszen akármerre is mennél,\r\nMindig utolér az utolsó levél.\r\n\r\nEz egy utolsó levél és vége van.\r\nÉreztem valamit, azt hiszem,\r\nSzégyellni kéne most magam,\r\nÁrnyékot vetsz a szívemen.\r\n\r\nVárj!\r\nTudod, hogy hiába menekülsz,\r\nHiszen akármerre is mennél,\r\nMindig utolér az utolsó levél.\r\n\r\nVárj!\r\nTudod, hogy hiába menekülsz,\r\nHiszen akármerre is mennél,\r\nMindig utolér az utolsó levél.\r\n\r\nVárj!\r\nTudod, hogy hiába menekülsz,\r\nHiszen akármerre is mennél,\r\nMindig utolér az utolsó levél.\r\n\r\nVárj!\r\nTudod, hogy hiába menekülsz,\r\nHiszen akármerre is mennél,\r\nMindig utolér az utolsó levél.'),
(26, 'it', 13, 'Az én filmem kész', '00:03:35', 'Az én filmem kész,\r\nLátod, megcsináltam már.\r\nRám csak a Semmi vár,\r\nA Feledés. '),
(27, 'ut', 1, 'Új törvény', '00:03:29', NULL),
(28, 'ut', 2, 'Alig hitted', '00:04:14', NULL),
(29, 'ut', 3, 'Egyetlen egy', '00:04:36', NULL),
(30, 'ut', 4, 'Virrasztó', '00:03:29', NULL),
(31, 'ut', 5, 'Majom a ketrecben', '00:03:29', NULL),
(32, 'ut', 6, 'A kezdet előtt', '00:04:40', NULL),
(33, 'ut', 7, 'A bosszú népe', '00:04:18', NULL),
(34, 'ut', 8, 'Be lettél oltva', '00:04:16', NULL),
(35, 'ut', 9, 'Conquistador', '00:04:14', NULL),
(36, 'ut', 10, 'Ölelj meg újra', '00:03:53', NULL),
(37, 'ut', 11, 'Élj a mában', '00:03:22', NULL),
(38, 'ut', 12, 'Altató', '00:05:55', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `eloado`
--

CREATE TABLE `eloado` (
  `id` char(4) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'Az előadó egyedi azonosítója',
  `nev` varchar(64) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'Az előadó neve'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Könnyűzenei előadók';

--
-- A tábla adatainak kiíratása `eloado`
--

INSERT INTO `eloado` (`id`, `nev`) VALUES
('ka', 'Ákos'),
('kpb', 'Kispál és a Borz');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `dal`
--
ALTER TABLE `dal`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `eloado`
--
ALTER TABLE `eloado`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `dal`
--
ALTER TABLE `dal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Dal egyedi azonosítója', AUTO_INCREMENT=39;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
