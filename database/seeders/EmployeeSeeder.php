<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("INSERT INTO `employees` (`id`, `name`, `email`, `phone`, `position_id`, `group_id`, `created_at`, `updated_at`) VALUES
            (3, 'HERU SUTISNA', NULL, '6281524808394', 2, 5, NULL, '2025-01-25 08:57:48'),
            (4, 'M RIZKY ALFIAN', NULL, '6283191761265', 2, 4, NULL, '2025-01-25 09:03:11'),
            (5, 'WASMAN', NULL, '6282117164996', 2, 5, NULL, '2025-01-25 08:57:48'),
            (6, 'CARSUDI', NULL, '6281298538081', 2, 5, NULL, '2025-01-25 08:57:48'),
            (7, 'RENDI ARDIYANSYAH', NULL, '6283125205840', 2, 10, NULL, '2025-01-25 08:19:13'),
            (8, 'AHMAD BUDIMAN', NULL, '628995588259', 2, 5, NULL, '2025-01-25 08:57:48'),
            (9, 'ACHMAD ANSOR', NULL, '6285748646832', 2, 5, NULL, '2025-01-25 08:57:48'),
            (10, 'INDRA GANDANI', NULL, '6285975250345', 2, 5, NULL, '2025-01-25 08:57:48'),
            (11, 'BPK M SAIDIN', NULL, '', 1, NULL, NULL, NULL),
            (12, 'SONJAYA', NULL, '', 1, NULL, NULL, NULL),
            (14, 'INDRA SUCI SURYA TRI', NULL, '', 1, NULL, NULL, NULL),
            (16, 'KASDANI', NULL, '', 1, NULL, NULL, NULL),
            (19, 'CANDRA', NULL, '', 1, NULL, NULL, NULL),
            (21, 'TARINDA', NULL, '', 1, NULL, NULL, NULL),
            (38, 'JAYA RACHMAT', NULL, '', 1, NULL, NULL, NULL),
            (39, 'TOHIRIN', NULL, '', 1, NULL, NULL, NULL),
            (40, 'AHMAD YANI', NULL, '6282129023500', 2, NULL, NULL, NULL),
            (41, 'JOHANI', NULL, '62895357544883', 2, NULL, NULL, NULL),
            (42, 'WENDI1', NULL, '6283101259473', 2, 2, NULL, '2025-01-25 09:08:56'),
            (43, 'YOYON KUSYONO', NULL, '62895342928218', 2, 2, NULL, '2025-01-25 09:08:56'),
            (44, 'HADI KURNIAWAN', NULL, '6289636864501', 2, 1, NULL, '2025-01-25 09:12:13'),
            (45, 'AGUS SALIM', NULL, '62895630029007', 2, 2, NULL, '2025-01-25 09:08:56'),
            (46, 'YANDI', NULL, '6282130771474', 2, 7, NULL, '2025-01-25 08:48:51'),
            (47, 'JAYA KURSI AMINUDIN', NULL, '62895339866264', 2, 7, NULL, '2025-01-25 08:48:51'),
            (48, 'VIKI DE CAPRIO', NULL, '6289504204798', 2, 1, NULL, '2025-01-25 09:12:13'),
            (49, 'BUDIMAN', NULL, '628996098264', 2, 2, NULL, '2025-01-25 09:08:56'),
            (51, 'SUTRISNO', NULL, '6281775210924', 2, 8, NULL, '2025-01-25 08:40:51'),
            (53, 'SLAMET RIYADI', NULL, '6289623811766', 2, 8, NULL, '2025-01-25 08:40:51'),
            (54, 'KUSNUDIN', NULL, '6282214293087', 2, 8, NULL, '2025-01-25 08:40:51'),
            (55, 'SAYIDI', NULL, '6281216627646', 2, 8, NULL, '2025-01-25 08:40:51'),
            (56, 'MOHAMAD JAHARI', NULL, '62895411659626', 2, 8, NULL, '2025-01-25 08:40:51'),
            (57, 'TARWA', NULL, '6281214925458', 2, 8, NULL, '2025-01-25 08:40:51'),
            (60, 'ARI HARTANTOKO', NULL, '6285810614494', 2, NULL, NULL, NULL),
            (61, 'RIVAL FAUZI', NULL, '628568902235', 2, 10, NULL, '2025-01-25 08:19:13'),
            (62, 'SAHRUL PURNAMA', NULL, '6285691786564', 2, 14, NULL, '2025-01-25 07:58:31'),
            (63, 'RIZKI MAULANA SIDIK', NULL, '6281319153459', 2, 14, NULL, '2025-01-25 07:58:31'),
            (64, 'ARLAN SETIAWAN', NULL, '6289504751053', 2, 2, NULL, '2025-01-25 09:08:56'),
            (65, 'AGUS PURNAMA', NULL, '6289632357728', 2, 2, NULL, '2025-01-25 09:08:56'),
            (66, 'ARDIYANTO', NULL, '6289673695929', 2, 7, NULL, '2025-01-25 08:48:51'),
            (67, 'SANUDIN', NULL, '6289528896778', 2, 7, NULL, '2025-01-25 08:48:51'),
            (68, 'SAEFUDIN', NULL, '628569821679', 2, 4, NULL, '2025-01-25 09:03:11'),
            (69, 'HENDRA', NULL, '6281288403064', 2, 10, NULL, '2025-01-25 08:19:13'),
            (70, 'SUGANDA', NULL, '6285781435499', 2, 10, NULL, '2025-01-25 08:19:13'),
            (71, 'IRWANTO', NULL, '62895622489341', 2, 13, NULL, '2025-01-25 08:08:03'),
            (73, 'DEDE RAMLI', NULL, '6283189331143', 2, 14, NULL, '2025-01-25 07:58:31'),
            (74, 'YAYAN ALPIYAN', NULL, '6285885003689', 2, 1, NULL, '2025-01-25 09:12:13'),
            (75, 'AHMAD SAMIRIADO', NULL, '6289630092145', 2, 1, NULL, '2025-01-25 09:12:13'),
            (76, 'KARDITA', NULL, '6281319153459', 2, NULL, NULL, NULL),
            (77, 'SAEPUL MAIDAN', NULL, '6285710407009', 2, 14, NULL, '2025-01-25 07:58:31'),
            (78, 'YAYAN', NULL, '6285880716946', 2, 14, NULL, '2025-01-25 07:58:31'),
            (79, 'ABDULAH', NULL, '628234678706', 2, 13, NULL, '2025-01-25 08:08:03'),
            (80, 'BACIM', NULL, '628234678706', 2, 14, NULL, '2025-01-25 07:58:31'),
            (81, 'RIZKY GILANG RAMADHAN', NULL, '6285780067739', 2, 12, NULL, '2025-01-25 08:13:10'),
            (82, 'SYAIPULLOH', NULL, '6281213273755', 2, 2, NULL, '2025-01-25 09:08:56'),
            (83, 'DARMA', NULL, '628710729880', 2, 14, NULL, '2025-01-25 07:58:31'),
            (84, 'IPANG', NULL, '6285880715124', 2, 14, NULL, '2025-01-25 07:58:31'),
            (85, 'KARMA', NULL, '6281586581398', 2, 14, NULL, '2025-01-25 07:58:31'),
            (86, 'DASIM', NULL, '6285718371543', 2, 14, NULL, '2025-01-25 07:58:31'),
            (87, 'TAMIN', NULL, '6285817963295', 2, 8, NULL, '2025-01-25 08:40:51'),
            (88, 'ADE ROHELI', NULL, '6282121612787', 2, 12, NULL, '2025-01-25 08:13:10'),
            (89, 'ROBANI', NULL, '6283879824261', 2, 14, NULL, '2025-01-25 07:58:31'),
            (90, 'ILYAS RUHIAT', NULL, '6285693269558', 2, 9, NULL, '2025-01-25 08:37:58'),
            (91, 'JAYADI', NULL, '628161140626', 2, 14, NULL, '2025-01-25 07:58:31'),
            (92, 'DIKI RIZKIAN HIDAYAT', NULL, '6282336723262', 2, 1, NULL, '2025-01-25 09:12:13'),
            (94, 'ALDIANSYAH PUTRA', NULL, '6285656058352', 2, 2, NULL, '2025-01-25 09:08:56'),
            (96, 'AHMAD SUKAMTO', NULL, '6281211143535', 2, 11, NULL, '2025-01-25 08:16:09'),
            (97, 'MUHAMAT DZARKASIH', NULL, '6288289778937', 2, 12, NULL, '2025-01-25 08:13:10'),
            (98, 'FIRMAN TANJUNG', NULL, '6285776938781', 2, 12, NULL, '2025-01-25 08:13:10'),
            (100, 'DULHADI', NULL, '6282118111763', 2, 7, NULL, '2025-01-25 08:48:51'),
            (101, 'AKDI', NULL, '6282385194448', 2, 8, NULL, '2025-01-25 08:40:51'),
            (102, 'MALIK PAAT', NULL, '628978562496', 2, 8, NULL, '2025-01-25 08:40:51'),
            (103, 'SUTODI', NULL, '6281572251685', 2, 8, NULL, '2025-01-25 08:40:51'),
            (106, 'ADAM GIBRAN', NULL, '6281224213934', 2, 11, NULL, '2025-01-25 08:16:09'),
            (108, 'CARMIN', NULL, '62895393557554', 2, 14, NULL, '2025-01-25 07:58:31'),
            (113, 'MUHAMMAD ADAM', NULL, '6289673907401', 2, 11, NULL, '2025-01-25 08:16:09'),
            (117, 'RONI SAPUTRA', NULL, '6287713226360', 2, 11, NULL, '2025-01-25 08:16:09'),
            (118, 'DEDE ANDRI IRAWAN', NULL, '6281212208384', 2, NULL, NULL, NULL),
            (119, 'AHMAD SARIPUDIN', NULL, '6282177127500', 2, 11, NULL, '2025-01-25 08:16:09'),
            (120, 'RIZKY ALBAR', NULL, '6283117995248', 2, 11, NULL, '2025-01-25 08:16:09'),
            (123, 'YAYANG TRI YOMARTHA', NULL, '6282299116770', 2, 11, NULL, '2025-01-25 08:16:09'),
            (127, 'ASMAN', NULL, '6281511910313', 2, 5, NULL, '2025-01-25 08:57:48'),
            (128, 'DARSA HIDAYAT', NULL, '6287804095151', 2, 5, NULL, '2025-01-25 08:57:48'),
            (131, 'DEDI PURWANTO', NULL, '628156034900', 2, 4, NULL, '2025-01-25 09:03:11'),
            (133, 'HERIYANTO', NULL, '6285324740376', 2, 5, NULL, '2025-01-25 08:57:48'),
            (135, 'AHMAD M MARUFF', NULL, '6281914917198', 2, 5, NULL, '2025-01-25 08:57:48'),
            (136, 'TEGUH', NULL, '6281220177160', 2, 2, NULL, '2025-01-25 09:08:56'),
            (137, 'ADE JUNAEDI', NULL, '6283861583635', 2, 5, NULL, '2025-01-25 08:57:48'),
            (138, 'NATA', NULL, '6282310433255', 2, NULL, NULL, NULL),
            (139, 'SUHENDAR', NULL, '6285694371557', 2, 5, NULL, '2025-01-25 08:57:48'),
            (140, 'RAHMAT HIDAYAT', NULL, '6285894574557', 2, NULL, NULL, NULL),
            (141, 'AYO SETIAWAN', NULL, '6285216019547', 2, 5, NULL, '2025-01-25 08:57:48'),
            (143, 'VIKTORANTONIO', NULL, '6282317171701', 2, 14, NULL, '2025-01-25 07:58:31'),
            (151, 'SUKENDAR', NULL, '628973832511', 2, 11, NULL, '2025-01-25 08:16:09'),
            (152, 'ADE MUHAMMAD', NULL, '6287820163447', 2, NULL, NULL, NULL),
            (153, 'ZAKY ARYO', NULL, '6285643508500', 2, 6, NULL, '2025-01-25 08:53:24'),
            (154, 'FAYZAR HIDAYAT', NULL, '6288239624974', 2, 6, NULL, '2025-01-25 08:53:24'),
            (156, 'SEPTI ANDRI', NULL, '6282340422004', 2, NULL, NULL, NULL),
            (157, 'DEDE RIAN', NULL, '62859152938382', 2, 6, NULL, '2025-01-25 08:53:24'),
            (158, 'KRISNA ADIT', NULL, '6285786593537', 2, 6, NULL, '2025-01-25 08:53:24'),
            (159, 'DEDE ARISANDI', NULL, '6283106717445', 2, 6, NULL, '2025-01-25 08:53:24'),
            (163, 'DIES AJI SAPUTRA', NULL, '6281511686256', 2, 6, NULL, '2025-01-25 08:53:24'),
            (164, 'JENRI GUNAWAN', NULL, '6288973205073', 2, NULL, NULL, NULL),
            (165, 'MOCH CHANDRA', NULL, '6281219005133', 2, 6, NULL, '2025-01-25 08:53:24'),
            (167, 'EKA WAHYU', NULL, '6288226771554', 2, 6, NULL, '2025-01-25 08:53:24'),
            (168, 'TEGAR DWI CANDRA', NULL, '62895358945115', 2, 6, NULL, '2025-01-25 08:53:24'),
            (169, 'WAGIMAN', NULL, '6285313782397', 2, NULL, NULL, NULL),
            (170, 'SISWOKO', NULL, '6282183845230', 2, 6, NULL, '2025-01-25 08:53:24'),
            (171, 'TRIMANTO', NULL, '6285786425052', 2, 6, NULL, '2025-01-25 08:53:24'),
            (172, 'M. ABDUL GOFUR', NULL, '628561630767', 2, 6, NULL, '2025-01-25 08:53:24'),
            (173, 'FAJAR ARIFIN', NULL, '6288224654140', 2, 6, NULL, '2025-01-25 08:53:24'),
            (174, 'AGA CHRISTIANTO', NULL, '6282136101201', 2, 6, NULL, '2025-01-25 08:53:24'),
            (175, 'BIMA ARI', NULL, '6283863404411', 2, 6, NULL, '2025-01-25 08:53:24'),
            (176, 'AVO MAULANA', NULL, '6289508918436', 2, 6, NULL, '2025-01-25 08:53:24'),
            (177, 'ARIF SUGIARTO', NULL, '6288213760785', 2, 6, NULL, '2025-01-25 08:53:24'),
            (178, 'SEHAT ARDIYANTO', NULL, '6281329590758', 2, 6, NULL, '2025-01-25 08:53:24'),
            (179, 'MUFTADIN', NULL, '6289607440304', 2, 6, NULL, '2025-01-25 08:53:24'),
            (180, 'MOHAMAD AGUNG', NULL, '6281221162643', 2, 6, NULL, '2025-01-25 08:53:24'),
            (185, 'ARISSUTRISNO', NULL, '6285715979786', 2, 12, NULL, '2025-01-25 08:13:10'),
            (189, 'DARMA', NULL, NULL, 2, NULL, NULL, NULL),
            (190, 'SUTRISNO', NULL, NULL, 2, NULL, NULL, NULL),
            (191, 'HARRYABDULAH', NULL, '6282124280196', 2, NULL, NULL, NULL),
            (194, 'ULINHIDAYATULLAH', NULL, '6289520441481', 2, 2, NULL, '2025-01-25 09:08:56'),
            (196, 'MUHAMMAD RIZA RIVALDA', NULL, '6282218106991', 2, 14, NULL, NULL),
            (197, 'INDIR', NULL, '6285771080802', 2, 13, NULL, '2025-01-25 08:08:03'),
            (198, 'AMAD JULAENI', NULL, '6285783970561', 2, NULL, NULL, NULL),
            (201, 'AVID MARUF', NULL, '6281227988916', 2, NULL, NULL, NULL),
            (202, 'MARGANI AL AYUBI', NULL, '6285892113831', 2, 6, NULL, '2025-01-25 08:53:24'),
            (204, 'ANGGA APRIYANTO', NULL, '6285691751319', 2, 6, NULL, '2025-01-25 08:53:24'),
            (205, 'KEVIN ADAM', NULL, '6281243514385', 2, 6, NULL, '2025-01-25 08:53:24'),
            (206, 'TATAN S', NULL, '6282117938586', 2, 5, NULL, '2025-01-25 08:57:48'),
            (210, 'DARTO', NULL, '', 1, NULL, NULL, NULL),
            (211, 'SANTORI', NULL, '', 1, NULL, NULL, NULL),
            (212, 'MAULANAHADISETIAWAN', NULL, '', 1, NULL, NULL, NULL),
            (216, 'HENDRY', NULL, '', 1, NULL, NULL, NULL),
            (219, 'MUSTIKA', NULL, '', 1, NULL, NULL, NULL),
            (223, 'SUKIRWAN', NULL, '', 1, NULL, NULL, NULL),
            (227, 'FRADITYA ABIRASYA', NULL, '6285777335237', 2, 12, NULL, '2025-01-25 08:13:10'),
            (228, 'MOHAMMAD IRGIAN SAPUTRA', NULL, '6285775265057', 2, 12, NULL, '2025-01-25 08:13:10'),
            (229, 'LUHUNG AGUNG GUMELAR', NULL, '6283850211076', 2, 11, NULL, '2025-01-25 08:16:09'),
            (230, 'KUSNADI', NULL, '6285887497595', 2, 9, NULL, '2025-01-25 08:37:58'),
            (231, 'TARNYA S', NULL, '6285772633493', 2, 11, NULL, '2025-01-25 08:16:09'),
            (232, 'SAEFUDIN', NULL, '6289673858218', 2, 10, NULL, '2025-01-25 08:19:13'),
            (233, 'SAMHARI', NULL, '6283871913855', 2, 9, NULL, '2025-01-25 08:37:58'),
            (234, 'SUGANDI', NULL, '628121866987', 2, 11, NULL, '2025-01-25 08:16:09'),
            (235, 'KELVIN ROBI', NULL, '6285697509370', 2, 12, NULL, '2025-01-25 08:13:10'),
            (236, 'DEDE NASIHIN', NULL, '6283133923600', 2, 11, NULL, '2025-01-25 08:16:09'),
            (237, 'CARHENDI', NULL, '6285624384792', 2, 11, NULL, '2025-01-25 08:16:09'),
            (239, 'DASUM SUBAGIA', NULL, '6285894912532', 2, 9, NULL, '2025-01-25 08:37:58'),
            (243, 'ABDUROHAMAN', NULL, '6285673441686', 2, 14, NULL, '2025-01-25 07:58:31'),
            (249, 'AJIE', NULL, '', 1, NULL, NULL, NULL),
            (252, 'AGUS YULIANTO', NULL, '6287794142088', 2, 6, NULL, '2025-01-25 08:53:24'),
            (253, 'DIYAS', NULL, '6282336591106', 2, 11, NULL, '2025-01-25 08:16:09'),
            (254, 'DARMIN', NULL, '6283865526287', 2, 8, NULL, '2025-01-25 08:40:51'),
            (255, 'JUWADI', NULL, '6288294970184', 2, 11, NULL, '2025-01-25 08:16:09'),
            (256, 'KOBAR DWI PANJALU', NULL, '62895329633437', 2, 11, NULL, '2025-01-25 08:16:09'),
            (257, 'TARYADI', NULL, '6283861622417', 2, 5, NULL, '2025-01-25 08:57:48'),
            (258, 'MOH ADIN AL FAUZI', NULL, '6285862344130', 2, 5, NULL, '2025-01-25 08:57:48'),
            (259, 'YUDI WAHYUDI', NULL, '6285846850134', 2, 5, NULL, '2025-01-25 08:57:48'),
            (260, 'HASAN SATIRI', NULL, '6281382406655', 2, 7, NULL, '2025-01-25 08:48:51'),
            (261, 'DADAN GINANJAR', NULL, '6282336596029', 2, 11, NULL, '2025-01-25 08:16:09'),
            (262, 'SUTARJO', NULL, '628999432224', 2, 12, NULL, '2025-01-25 08:13:10'),
            (263, 'JUHADI MUSTAQIN', NULL, '6285782628400', 2, 12, NULL, '2025-01-25 08:13:10'),
            (265, 'SUWANDI KAMALUDIN', NULL, '6285695991351', 2, 11, NULL, '2025-01-25 08:16:09'),
            (266, 'M RUSLI', NULL, '6285770490876', 2, 7, NULL, '2025-01-25 08:48:51'),
            (267, 'INDIRAWAN', NULL, '6289527003566', 2, 7, NULL, '2025-01-25 08:48:51'),
            (268, 'JAMAN', NULL, '6285880905979', 2, 9, NULL, '2025-01-25 08:37:58'),
            (269, 'A AGIM MANDALA PUTRA', NULL, '6285777140976', 2, 9, NULL, '2025-01-25 08:37:58'),
            (270, 'ACHMAD SUHARNO', NULL, '628999432224', 2, 7, NULL, '2025-01-25 08:48:51'),
            (271, 'KHOIRUM NIAM', NULL, '6282310975039', 2, 10, NULL, '2025-01-25 08:19:13'),
            (272, 'DEDE HENDRIK KUSTIAWAN', NULL, '6281219949883', 2, 7, NULL, '2025-01-25 08:48:51'),
            (278, 'HENDRO', NULL, '6287779800684', 2, 10, NULL, '2025-01-25 08:19:13'),
            (279, 'SYARIPUDIN', NULL, '6285759191939', 2, 12, NULL, '2025-01-25 08:13:10'),
            (281, 'MUHAMMAD APRI LILIYAN', NULL, '6287835324101', 2, NULL, NULL, NULL),
            (288, 'SURYA WAHYUDIN', NULL, '628889675150', 2, 9, NULL, '2025-01-25 08:37:58'),
            (289, 'KARNOTO', NULL, '6287724408681', 2, 14, NULL, '2025-01-25 07:58:31'),
            (290, 'WAHYUDIN', NULL, '6285711210340', 2, 9, NULL, '2025-01-25 08:37:58'),
            (292, 'AMANATSYAHRIL', NULL, '6282126669060', 3, NULL, NULL, NULL),
            (293, 'INDUSTRIANTO', NULL, '6282214036647', 3, NULL, NULL, NULL),
            (294, 'ADEIBRAHIM', NULL, '6281912915758', 3, NULL, NULL, NULL),
            (295, 'NASIKIN', NULL, '6289661039015', 3, NULL, NULL, NULL),
            (296, 'KUSNADI', NULL, '6281315123844', 3, NULL, NULL, NULL),
            (297, 'NURINTO', NULL, '6281218827922', 3, NULL, NULL, NULL),
            (298, 'SUTARMAN', NULL, '6285721719645', 3, NULL, NULL, NULL),
            (299, 'SUDIN', NULL, '6281315111700', 3, NULL, NULL, NULL),
            (300, 'RIZKY ALFIAN SAPUTRA', NULL, '6281388536045', 2, 6, NULL, '2025-01-25 08:53:24'),
            (301, 'DANI ANWAR', NULL, '6281388536045', 2, 6, NULL, '2025-01-25 08:53:24'),
            (302, 'EKOLUKMANULHAKIM', NULL, '6288276647422', 3, NULL, NULL, NULL),
            (305, 'RIZAL RIZKY FAUZI', NULL, '6283817463856', 2, 7, NULL, '2025-01-25 08:48:51'),
            (306, 'PUTYI ASTOWO', NULL, '6282224053002', 2, 1, NULL, '2025-01-25 09:12:13'),
            (307, 'M BANGKIT DIMAS PUTRA', NULL, '6281334385571', 2, 1, NULL, '2025-01-25 09:12:13'),
            (308, 'BIMA PUTRA PRATAMA', NULL, '62895606062040', 2, 7, NULL, '2025-01-25 08:48:51'),
            (309, 'HOSEA NICO ADITYA', NULL, '6281334039462', 2, 9, NULL, '2025-01-25 08:37:58'),
            (310, 'RIZAL MUTAQIN', NULL, '', 2, 7, NULL, '2025-01-25 08:48:51'),
            (311, 'ANDRIK SUSANTO', NULL, '6281230473986', 2, 2, NULL, '2025-01-25 09:08:56'),
            (312, 'ABDUL ROSJAD', NULL, '62881026573273', 2, 9, NULL, '2025-01-25 08:37:58'),
            (313, 'HASANUDIN', NULL, '6287719662028', 2, 9, NULL, '2025-01-25 08:37:58'),
            (314, 'RAGIL DWI', NULL, '6282243345801', 2, 1, NULL, '2025-01-25 09:12:13'),
            (315, 'IBNU ARIEF', NULL, '6282111337113', 2, 9, NULL, '2025-01-25 08:37:58'),
            (316, 'PUJI SETIAWAN', NULL, '6285231739513', 2, 1, NULL, '2025-01-25 09:12:13'),
            (317, 'HERMAN FELANY', NULL, '6285231116226', 2, 2, NULL, '2025-01-25 09:08:56'),
            (318, 'SUNARJI', NULL, '6285331606286', 2, 2, NULL, '2025-01-25 09:08:56'),
            (319, 'HENDARSO', NULL, '6282240460114', 2, 7, NULL, '2025-01-25 08:48:51'),
            (320, 'EDI JUBAEDI', NULL, '6282128455644', 2, 7, NULL, '2025-01-25 08:48:51'),
            (321, 'SUPRAPTO', NULL, '6282111400120', 2, 2, NULL, '2025-01-25 09:08:56'),
            (322, 'ABDUL HAMID', NULL, '62895366910394', 2, 9, NULL, '2025-01-25 08:37:58'),
            (323, 'RUDY HENDRIK', NULL, '62812846281778', 2, 7, NULL, '2025-01-25 08:48:51'),
            (324, 'ALBERT FERDINAN', NULL, '6285814366891', 2, 7, NULL, '2025-01-25 08:48:51'),
            (329, 'SUSANTO', NULL, '6282298965572', 2, 8, NULL, '2025-01-25 08:40:51'),
            (330, 'M MUIZUL MUHDIL', NULL, '6282141592676', 2, 9, NULL, '2025-01-25 08:37:58'),
            (331, 'ENKAY', NULL, '6283172531177', 2, 9, NULL, '2025-01-25 08:37:58'),
            (332, 'SAEPUL BAHRI', NULL, '6285888673607', 2, 9, NULL, '2025-01-25 08:37:58'),
            (333, 'TURMUDI', NULL, '6285313166318', 2, NULL, NULL, NULL),
            (334, 'BAMBANG EKA SUKARDI', NULL, '6282119700669', 2, 9, NULL, '2025-01-25 08:37:58'),
            (335, 'ABDUL ZAKA', NULL, '6285201902986', 2, NULL, NULL, NULL),
            (336, 'FANDI', NULL, '6281249635558', 2, 11, NULL, '2025-01-25 08:16:09'),
            (337, 'NARA SUKMARA', NULL, '6281344601837', 2, 9, NULL, '2025-01-25 08:37:58'),
            (338, 'AHMAD SAIHU', NULL, '6285814380134', 2, 7, NULL, '2025-01-25 08:48:51'),
            (339, 'YOGI SETIAWAN', NULL, '6285814380134', 2, 5, NULL, '2025-01-25 08:57:48'),
            (341, 'PARISEBERHATSIREGAR', NULL, '6281290152555', 3, NULL, NULL, NULL),
            (342, 'MADRONI', NULL, '6282118789960', 2, 1, NULL, '2025-01-25 09:12:13'),
            (343, 'MUHAMAD SYATORIH', NULL, '6282290423123', 2, NULL, NULL, NULL),
            (344, 'SANTOSO', NULL, '6281297847946', 2, NULL, NULL, NULL),
            (345, 'AHMAD SUSANTO', NULL, '6281321239040', 2, 11, NULL, '2025-01-25 08:16:09'),
            (346, 'SUDARNO', NULL, '6282114348572', 2, NULL, NULL, NULL),
            (347, 'JOKO SUGIYARTO', NULL, '6281393556792', 2, 9, NULL, '2025-01-25 08:37:58'),
            (348, 'DANANG SODIQ', NULL, '6281284185315', 2, 9, NULL, '2025-01-25 08:37:58'),
            (349, 'SUPARMIN', NULL, '6289512090736', 2, NULL, NULL, NULL),
            (350, 'MARYANTO', NULL, '6281221407622', 2, 13, NULL, '2025-01-25 08:08:03'),
            (351, 'FARDAN BHAKTI KHAKIKI', NULL, '6285326963667', 2, NULL, NULL, NULL),
            (352, 'ICANG SETIAWAN', NULL, '6281280144313', 2, NULL, NULL, NULL),
            (353, 'ABU CHOIR', NULL, '6282142987570', 2, 14, NULL, '2025-01-25 07:58:31'),
            (354, 'ACHMAD FIRDAUS FIRMANSYAH', NULL, '6282142505520', 2, 2, NULL, '2025-01-25 09:08:56'),
            (355, 'APRI ZATUL ANWAR', NULL, '6285658888963', 2, NULL, NULL, NULL),
            (356, 'MUSTAR', NULL, '6281296741500', 2, NULL, NULL, NULL),
            (357, 'ACHMAD JAELANI', NULL, '6287843957971', 2, 9, NULL, '2025-01-25 08:37:58'),
            (358, 'ANGKI PRADANA', NULL, '6282213005457', 2, 9, NULL, '2025-01-25 08:37:58'),
            (359, 'M BAYU DIKTA ANANTA', NULL, '6281326451767', 2, 13, NULL, '2025-01-25 08:08:03'),
            (360, 'HIDJRA KIBRAKA', NULL, '6281219965597', 2, NULL, NULL, NULL),
            (361, 'MOH SUBAKRI', NULL, '6281217855294', 2, 13, NULL, '2025-01-25 08:08:03'),
            (362, 'JAENUDIN', NULL, '6287741051487', 2, 13, NULL, '2025-01-25 08:08:03'),
            (363, 'SUGIYANTO', NULL, '6281548641205', 2, NULL, NULL, NULL),
            (364, 'MUHAMMAD JATMIKO', NULL, '6285655820377', 2, NULL, NULL, NULL),
            (365, 'HARSONO', NULL, '6282337297379', 2, 9, NULL, '2025-01-25 08:37:58'),
            (366, 'SOLEH FAJAR', NULL, '6285212914760', 2, 10, NULL, '2025-01-25 08:19:13'),
            (367, 'MUHAMMAD ANIS', NULL, '6289524453368', 2, NULL, NULL, NULL),
            (369, 'TRI SUTRISNO', NULL, '62882128269628', 2, 13, NULL, '2025-01-25 08:08:03'),
            (370, 'MOCHAMAD ALFANDI ABDILLAH', NULL, '62813850628900', 2, 13, NULL, '2025-01-25 08:08:03'),
            (371, 'AJID ROVAL ANAM', NULL, '6282299320440', 2, NULL, NULL, NULL),
            (372, 'ILHAM OKTA REFIAN HERBIANTO', NULL, '62881027842352', 2, 13, NULL, '2025-01-25 08:08:03'),
            (373, 'ABDULLAH', NULL, '6285748347854', 2, 14, NULL, '2025-01-25 07:58:31'),
            (374, 'TARMUJI', NULL, '6282302471659', 2, 14, NULL, '2025-01-25 07:58:31'),
            (375, 'HAFIZ BACHTIAR', NULL, '6282302471659', 2, 14, NULL, '2025-01-25 07:58:31'),
            (376, 'SURAHMAN ', NULL, '6281313222312', 2, 5, NULL, '2025-01-25 08:57:48'),
            (377, 'SAMSUL HADI', NULL, '6287852410717', 2, 4, NULL, '2025-01-25 09:03:11'),
            (378, 'SUTARNO', NULL, '6281267404912', 2, 5, NULL, '2025-01-25 08:57:48'),
            (379, 'ABDUL RAHMAN', NULL, '6287832852331', 2, 5, NULL, '2025-01-25 08:57:48'),
            (380, 'DEDEN AGUSTIAWAN', NULL, '6285759192317', 2, NULL, NULL, NULL),
            (381, 'EKI KUSNADI', NULL, '6287736425653', 2, 4, NULL, '2025-01-25 09:03:11'),
            (382, 'BUKI SURYANTO', NULL, '6281320334211', 2, 4, NULL, '2025-01-25 09:03:11'),
            (383, 'KATA', NULL, '6285925284860', 2, 4, NULL, '2025-01-25 09:03:11'),
            (384, 'CARDI EFENDI', NULL, '6285211620509', 2, 5, NULL, '2025-01-25 08:57:48'),
            (385, 'MOHAMMAD DEDI SURJANA', NULL, '62895375650870', 2, 4, NULL, '2025-01-25 09:03:11'),
            (386, 'ADE NURYANA', NULL, '6287717227222', 2, 5, NULL, '2025-01-25 08:57:48'),
            (388, 'GILANG SAPUTRA', NULL, '6283876044474', 2, 4, NULL, '2025-01-25 09:03:11'),
            (389, 'SADI', NULL, '6285891103310', 2, 14, NULL, '2025-01-25 07:58:31'),
            (390, 'IWAN', NULL, '6283830519542', 2, 14, NULL, '2025-01-25 07:58:31'),
            (391, 'BASOFI SULISTIANTO', NULL, '6285881283161', 2, 14, NULL, '2025-01-25 07:58:31'),
            (392, 'IMAM ARIFUDIN SAIFUL AZIZ', NULL, '6285250272747', 2, 1, NULL, '2025-01-25 09:12:13'),
            (393, 'GUNARTO', NULL, '6285702131925', 2, 1, NULL, '2025-01-25 09:12:13'),
            (394, 'SUBUR', NULL, '62895375650870', 2, 4, NULL, '2025-01-25 09:03:11'),
            (395, 'FERY FIRMANSYAH ', NULL, '6285717639592', 2, 7, NULL, '2025-01-25 08:48:51'),
            (396, 'ANDRE WIBOWO', NULL, '628811812470', 2, 7, NULL, '2025-01-25 08:48:51'),
            (397, 'RINO WINDANY BASKORO', NULL, '6281212921072', 2, 7, NULL, '2025-01-25 08:48:51'),
            (398, 'ADITYO NURLIANTO', NULL, '6285718896624', 2, 7, NULL, '2025-01-25 08:48:51'),
            (399, 'MUHAMMAD INDRA SETIAWAN', NULL, '6285933272869', 2, 7, NULL, '2025-01-25 08:48:51'),
            (400, 'RENHARD PRATAMA', NULL, '6288975679997', 2, 7, NULL, '2025-01-25 08:48:51'),
            (401, 'NANDANG ATMA SUKANDAR', NULL, '6287807048686', 2, 7, NULL, '2025-01-25 08:48:51'),
            (402, 'ADE KURNIAWAN', NULL, '62895800059922', 2, 7, NULL, '2025-01-25 08:48:51'),
            (403, 'RAKHA SURYA PRATAMA', NULL, '6288219935892', 2, 7, NULL, '2025-01-25 08:48:51'),
            (404, 'KONTARA', NULL, '6281368855101', 2, 7, NULL, '2025-01-25 08:48:51'),
            (405, 'AHMAD SEPTIAN', NULL, '6287784250075', 2, 7, NULL, '2025-01-25 08:48:51'),
            (406, 'FREDY SETYAWAN', NULL, '6285803118464', 2, 5, NULL, '2025-01-25 08:57:48'),
            (407, 'BAGUS REFINDRA ARDIYANTO', NULL, '6281226599472', 2, 4, NULL, '2025-01-25 09:03:11'),
            (408, 'FARIZ AUGUSTA MULIAWAN', NULL, '6282133998131', 2, NULL, NULL, NULL),
            (409, 'ESA HADI PRASETYO', NULL, '6285604415174', 2, 1, NULL, '2025-01-25 09:12:13'),
            (410, 'DWI ARIYANTO', NULL, '6281217162382', 2, NULL, NULL, NULL),
            (412, 'MUHAMMAD RIDWAN ALI', NULL, '6281385327886', 2, 2, NULL, '2025-01-25 09:08:56'),
            (413, 'NUNU SUNTARA', NULL, '6285691134920', 2, 5, NULL, '2025-01-25 08:57:48'),
            (414, 'GUNTUR PERSADA TARIGAN', NULL, '628568980906', 2, 7, NULL, '2025-01-25 08:48:51'),
            (415, 'UNTUNG SUNANDAR', NULL, '6282334750910', 2, 1, NULL, '2025-01-25 09:12:13'),
            (416, 'SUYANTO', NULL, '6281397930405', 2, 1, NULL, '2025-01-25 09:12:13'),
            (417, 'SATRIA FATHUR ROSIDIN', NULL, '6287817135234', 2, 10, NULL, '2025-01-25 08:19:13'),
            (418, 'USMAN', NULL, '628990621866', 2, 5, NULL, '2025-01-25 08:57:48'),
            (419, 'ULUL FAHMI', NULL, '6281229410604', 2, 5, NULL, '2025-01-25 08:57:48'),
            (420, 'SURATMAN', NULL, '', 2, 10, NULL, '2025-01-25 08:19:13'),
            (421, 'TARYONO', NULL, '6283844326151', 2, 10, NULL, '2025-01-25 08:19:13'),
            (422, 'MOCH ARIS SUSANTO', NULL, '628816716342', 2, 1, NULL, '2025-01-25 09:12:13'),
            (423, 'SAPEI', NULL, '6281574624870', 2, 7, NULL, '2025-01-25 08:48:51'),
            (424, 'SAPENDI', NULL, '6282310433255', 2, 7, NULL, '2025-01-25 08:48:51'),
            (425, 'MUNAWIR', NULL, '6281220233529', 2, 5, NULL, '2025-01-25 08:57:48'),
            (426, 'MOH ROHMAT', NULL, '6282137112234', 2, 1, NULL, '2025-01-25 09:12:13'),
            (427, 'M ALI MAHFUDZ', NULL, '6285229044075', 2, 1, NULL, '2025-01-25 09:12:13'),
            (428, 'MOHAMMAD AGUNG ANNASAI', NULL, '6281999493792', 2, 1, NULL, '2025-01-25 09:12:13'),
            (429, 'MISSRA', NULL, '6282148613676', 2, 7, NULL, '2025-01-25 08:48:51'),
            (430, 'MUHAMMAD FADILAH TANJUNG', NULL, '6289698909230', 2, 8, NULL, '2025-01-25 08:40:51'),
            (431, 'MURSIDAN', NULL, '6289512960036', 2, NULL, NULL, NULL),
            (432, 'RUSMINTO', NULL, '6282338867245', 2, 1, NULL, '2025-01-25 09:12:13'),
            (434, 'JARI', NULL, '62895374780096', 2, 4, NULL, '2025-01-25 09:03:11'),
            (435, 'DEDE ROHIM', NULL, '6289514345425', 2, NULL, NULL, NULL),
            (436, 'ALPIAN', NULL, '6285710731632', 2, 13, NULL, '2025-01-25 08:08:03'),
            (437, 'HERU WAHYUDI', NULL, '6285813649796', 2, 13, NULL, '2025-01-25 08:08:03'),
            (438, 'MASTO', NULL, '62895388655656', 2, 8, NULL, '2025-01-25 08:40:51'),
            (439, 'FAISAL', NULL, '6285771098351', 2, 14, NULL, '2025-01-25 07:58:31'),
            (440, 'ANDRI HIDAYAT', NULL, '6288291947436', 2, 11, NULL, '2025-01-25 08:16:09'),
            (441, 'MAHARDIKA', NULL, '628888503473', 2, 13, NULL, '2025-01-25 08:08:03'),
            (442, 'TIIN ANDRIYAWAN', NULL, '6285774302863', 2, 13, NULL, '2025-01-25 08:08:03'),
            (443, 'RAHMAT', NULL, '6285779651935', 2, 12, NULL, '2025-01-25 08:13:10'),
            (444, 'JAELANI', NULL, '6288291447565', 2, 13, NULL, '2025-01-25 08:08:03'),
            (445, 'HENDRA HERIAWAN', NULL, '628871896097', 2, 13, NULL, '2025-01-25 08:08:03'),
            (446, 'HUSEN AF', NULL, '6285693441686', 2, 14, NULL, '2025-01-25 07:58:31'),
            (447, 'MARSAN', NULL, '6281410767479', 2, 12, NULL, '2025-01-25 08:13:10'),
            (448, 'RIWAN', NULL, '6285692541036', 2, 12, NULL, '2025-01-25 08:13:10'),
            (449, 'ANDRI SAPUTRA', NULL, '6285697848551', 2, 10, NULL, '2025-01-25 08:19:13'),
            (450, 'VIKI ARDIANSYAH', NULL, '6285695317153', 2, 13, NULL, '2025-01-25 08:08:03'),
            (451, 'UMAR WIRA HADIKUSUMA', NULL, '6285892191657', 2, 14, NULL, '2025-01-25 07:58:31'),
            (452, 'ABDUL TONIK', NULL, '6281514315400', 2, 14, NULL, '2025-01-25 07:58:31'),
            (453, 'ROBI', NULL, '6281400320452', 2, 14, NULL, '2025-01-25 07:58:31'),
            (454, 'SAEPUDIN', NULL, '6285719821968', 2, 13, NULL, '2025-01-25 08:08:03'),
            (455, 'SOPIAN SOPIAN', NULL, '6289516263545', 2, 12, NULL, '2025-01-25 08:13:10'),
            (456, 'SAEPUDIN', NULL, NULL, 2, NULL, NULL, NULL),
            (457, 'KAMALUDIN 2', NULL, '', 2, 13, NULL, '2025-01-25 08:08:03'),
            (458, 'KEVIN SATYA PERMANA', NULL, '62895352638400', 2, 12, NULL, '2025-01-25 08:13:10'),
            (459, 'AWIN', NULL, '6285890091490', 2, 13, NULL, '2025-01-25 08:08:03'),
            (460, 'MUHAMMAD ABDUL RIZKI', NULL, '6285892865073', 2, 13, NULL, '2025-01-25 08:08:03'),
            (461, 'ARIS SAPUTRA', NULL, '6285811470042', 2, 11, NULL, '2025-01-25 08:16:09'),
            (462, 'ANDRI', NULL, '6289523014350', 2, 10, NULL, '2025-01-25 08:19:13'),
            (463, 'KAMALUDIN', NULL, '62882142305628', 2, 13, NULL, '2025-01-25 08:08:03'),
            (464, 'DAVID', NULL, '6285880911173', 2, 11, NULL, '2025-01-25 08:16:09'),
            (465, 'ELDAS BERLIN ANDREAN', NULL, '6289693166556', 2, 10, NULL, '2025-01-25 08:19:13'),
            (470, 'DIDIK DWI ANDRIANTO', NULL, '6281357532429', 2, 3, NULL, '2025-01-25 09:06:41'),
            (471, 'HARIYONO', NULL, '62895360400376', 2, 3, NULL, '2025-01-25 09:06:41'),
            (472, 'RUDIANA', NULL, '6281219154886', 2, 6, NULL, '2025-01-25 08:53:24'),
            (473, 'RIDHO MAULANA', NULL, '6287898020615', 2, 10, NULL, '2025-01-25 08:19:13'),
            (474, 'AMAT SODIK', NULL, '6281384748056', 2, 3, NULL, '2025-01-25 09:06:41'),
            (475, 'SEPTIAWAN NUGROHO', NULL, '62882165091628', 2, 3, NULL, '2025-01-25 09:06:41'),
            (476, 'SARIJAN', NULL, '6285692116428', 2, 3, NULL, '2025-01-25 09:06:41'),
            (477, 'DIMAS AJI PRABAKTI', NULL, '6288806181813', 2, 3, NULL, '2025-01-25 09:06:41'),
            (478, 'SIFATUL AKNAM NURFIGI', NULL, '6285641576320', 2, 3, NULL, '2025-01-25 09:06:41'),
            (479, 'TANAYA KUKUH PRAMIDHITA', NULL, '62887406285791', 2, 3, NULL, '2025-01-25 09:06:41'),
            (480, 'MUHAMAD ALFIANUDIN', NULL, '6281212447576', 2, 3, NULL, '2025-01-25 09:06:41'),
            (481, 'ARIS MUHAMAD EFENDI', NULL, '628568766712', 2, 3, NULL, '2025-01-25 09:06:41'),
            (482, 'SUTARYO', NULL, '6285878449767', 2, 3, NULL, '2025-01-25 09:06:41'),
            (483, 'RENO FIRMANSYAH', NULL, '6287894475318', 2, 3, NULL, '2025-01-25 09:06:41'),
            (484, 'HANA PRIANA', NULL, '628386255717', 2, 3, NULL, '2025-01-25 09:06:41'),
            (485, 'AJI SAMSUL LUTFI', NULL, '6285652193480', 2, 3, NULL, '2025-01-25 09:06:41'),
            (486, 'MUHAMMAD RIFKI ARDIANSYAH', NULL, '62859121461326', 2, 3, NULL, '2025-01-25 09:06:41'),
            (487, 'AWALUDIN ZAMIN', NULL, '6285723947228', 2, 1, NULL, '2025-01-25 09:12:13'),
            (488, 'ZEFRIANI', NULL, '6282119453980', 2, 10, NULL, '2025-01-25 08:19:13'),
            (489, 'REZHA VICKY ARIESTA', NULL, '6281384165602', 2, 3, NULL, '2025-01-25 09:06:41'),
            (490, 'IMAT ROHMAT', NULL, '62895353924128', 2, 3, NULL, '2025-01-25 09:06:41'),
            (491, 'IMAM AWALUDIN', NULL, '6285793711780', 2, 5, NULL, '2025-01-25 08:57:48'),
            (492, 'FANI GILANG RAMADAN', NULL, '6281314565551', 2, NULL, NULL, NULL),
            (493, 'ADE RIZAL NURDIN', NULL, '6283101515304', 2, 3, NULL, '2025-01-25 09:06:41'),
            (494, 'PIRMAN HADIANSYAH', NULL, '', 2, 5, NULL, '2025-01-25 08:57:48'),
            (495, 'LALUNA VIAN NUR RAMADHAN', NULL, '6283114994855', 2, 3, NULL, '2025-01-25 09:06:41'),
            (496, 'ANTON KRISBIANTO', NULL, '6281316167065', 2, 10, NULL, '2025-01-25 08:19:13'),
            (497, 'MUHAMMAD RIFQI', NULL, '6289698909230', 2, NULL, NULL, NULL),
            (498, 'AHMAD LUAY AZIZ', NULL, '62895380255178', 2, 3, NULL, '2025-01-25 09:06:41'),
            (499, 'AGUNG HARY PRASTIO', NULL, '6281271867571', 2, 3, NULL, '2025-01-25 09:06:41'),
            (500, 'DEANDRA ALIM ARINDITO', NULL, '6285799736976', 2, 3, NULL, '2025-01-25 09:06:41'),
            (501, 'MILENANTO ADE PURNOMO', NULL, '6282221698316', 2, 3, NULL, '2025-01-25 09:06:41'),
            (502, 'ADAM MALIK', NULL, '6287777973244', 2, 3, NULL, '2025-01-25 09:06:41'),
            (506, 'MUHAMADANDI', NULL, '', 4, NULL, NULL, NULL),
            (507, 'BUDIOPERATOR', NULL, '', 4, NULL, NULL, NULL),
            (508, 'EDITARIWIBOWO', NULL, '', 4, NULL, NULL, NULL),
            (509, 'MUHAMADRISKIRIANTO', NULL, '', 4, NULL, NULL, NULL),
            (510, 'IMAMOPERATOR', NULL, '', 4, NULL, NULL, NULL),
            (511, 'DIMASOPERATOR', NULL, '', 4, NULL, NULL, NULL),
            (512, 'JAENALOPERATOR', NULL, '', 4, NULL, NULL, NULL),
            (513, 'AGILOPERATOR', NULL, '', 4, NULL, NULL, NULL),
            (514, 'TONI HIDAYAT', NULL, '6285811777406', 2, NULL, NULL, NULL),
            (100001, 'APIP HAMBALI', NULL, '6285695344920', 2, NULL, NULL, NULL),
            (20221224, 'Achmad Fatoni (Test)', 'ahmad.fatoni@mindotek.com', '6289676490971', 1, 1, '2025-01-25 07:51:27', '2025-01-25 07:51:27');
        ");

        // ('129', 'DARMA', '6281293395988', '2'),
        // ('51', 'SUTRISNO', '6283897511188', '2'),
        // ('454', 'SAEPUDIN', '6285779694452', '2'),
    }
}
