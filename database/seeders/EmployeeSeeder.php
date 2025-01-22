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
        Employee::create([
            'id' => 20221224,
            'name' => 'Achmad Fatoni (Test)',
            'email' => 'ahmad.fatoni@mindotek.com',
            'phone' => '6289676490971',
            'position_id' => 1,
            'group_id' => 1
        ]);

        // DB::statement("
        //     INSERT INTO employees (`id`, `name`, `phone`) VALUES
        //         ('98', 'FIRMAN TANJUNG', '6285776938781'),
        //         ('97', 'MUHAMAT DZARKASIH', '6288289778937'),
        //         ('96', 'AHMAD SUKAMTO', '6281211143535'),
        //         ('94', 'ALDIANSYAH PUTRA', '6285656058352'),
        //         ('92', 'DIKI RIZKIAN HIDAYAT', '6282336723262'),
        //         ('91', 'JAYADI', '628161140626'),
        //         ('90', 'ILYAS RUHIAT', '6285693269558'),
        //         ('89', 'ROBANI', '6283879824261'),
        //         ('88', 'ADE ROHELI', '6282121612787'),
        //         ('87', 'TAMIN', '6285817963295'),
        //         ('86', 'DASIM', '6285718371543'),
        //         ('85', 'KARMA', '6281586581398'),
        //         ('84', 'IPANG', '6285880715124'),
        //         ('82', 'SYAIPULLOH', '6281213273755'),
        //         ('81', 'RIZKY GILANG RAMADHAN', '6285780067739'),
        //         ('80', 'BACIM', '628234678706'),
        //         ('79', 'ABDULAH', '628234678706'),
        //         ('78', 'YAYAN', '6285880716946'),
        //         ('77', 'SAEPUL MAIDAN', '6285710407009'),
        //         ('76', 'KARDITA', '6281319153459'),
        //         ('75', 'AHMAD SAMIRIADO', '6289630092145'),
        //         ('74', 'YAYAN ALPIYAN', '6285885003689'),
        //         ('73', 'DEDE RAMLI', '6283189331143'),
        //         ('71', 'IRWANTO', '62895622489341'),
        //         ('70', 'SUGANDA', '6285781435499'),
        //         ('69', 'HENDRA', '6281288403064'),
        //         ('68', 'SAEFUDIN', '628569821679'),
        //         ('68', 'SAEFUDIN', '6289673858218'),
        //         ('67', 'SANUDIN', '6289528896778'),
        //         ('66', 'ARDIYANTO', '6289673695929'),
        //         ('65', 'AGUS PURNAMA', '6289632357728'),
        //         ('64', 'ARLAN SETIAWAN', '6289504751053'),
        //         ('63', 'RIZKI MAULANA SIDIK', '6281319153459'),
        //         ('62', 'SAHRUL PURNAMA', '6285691786564'),
        //         ('61', 'RIVAL FAUZI', '628568902235'),
        //         ('60', 'ARI HARTANTOKO', '6285810614494'),
        //         ('6', 'CARSUDI', '6281298538081'),
        //         ('57', 'TARWA', '6281214925458'),
        //         ('56', 'MOHAMAD JAHARI', '62895411659626'),
        //         ('55', 'SAYIDI', '6281216627646'),
        //         ('54', 'KUSNUDIN', '6282214293087'),
        //         ('53', 'SLAMET RIYADI', '6289623811766'),
        //         ('51', 'SUTRISNO', '6281775210924'),
        //         ('51', 'SUTRISNO', '6283897511188'),
        //         ('5', 'WASMAN', '6282117164996'),
        //         ('49', 'BUDIMAN', '628996098264'),
        //         ('488', 'ZEFRIANI', '6282119453980'),
        //         ('482', 'SUTARYO', '6285878449767'),
        //         ('48', 'VIKI DE CAPRIO', '6289504204798'),
        //         ('476', 'SARIJAN', '6285692116428'),
        //         ('472', 'RUDIANA', '6281219154886'),
        //         ('471', 'HARIYONO', '62895360400376'),
        //         ('47', 'JAYA KURSI AMINUDIN', '62895339866264'),
        //         ('464', 'DAVID', '6285880911173'),
        //         ('463', 'KAMALUDIN', '6288214230508'),
        //         ('462', 'ANDRI', '6289523014350'),
        //         ('46', 'YANDI', '6282130771474'),
        //         ('459', 'AWIN', '6285890091490'),
        //         ('454', 'SAEPUDIN', '6285719821968'),
        //         ('454', 'SAEPUDIN', '6285779694452'),
        //         ('453', 'ROBI', '6281400320452'),
        //         ('45', 'AGUS SALIM', '62895630029007'),
        //         ('448', 'RIWAN', '6285692541036'),
        //         ('447', 'MARSAN', '6281410767479'),
        //         ('444', 'JAELANI', '6288291447565'),
        //         ('443', 'RAHMAT', '6285779651935'),
        //         ('441', 'MAHARDIKA', '628888503473'),
        //         ('44', 'HADI KURNIAWAN', '6289636864501'),
        //         ('439', 'FAISAL', '6285771098351'),
        //         ('438', 'MASTO', '62895388655656'),
        //         ('436', 'ALPIAN', '6285710731632'),
        //         ('434', 'JARI', '62895374780096'),
        //         ('432', 'RUSMINTO', '6282338867245'),
        //         ('431', 'MURSIDAN', '6289512960036'),
        //         ('43', 'YOYON KUSYONO', '62895342928218'),
        //         ('425', 'MUNAWIR', '6281220233529'),
        //         ('424', 'SAPENDI', '6282310433255'),
        //         ('423', 'SAPEI', '6281574624870'),
        //         ('421', 'TARYONO', '6283844326151'),
        //         ('420', 'SURATMAN', ''),
        //         ('42', 'WENDI1', '6283101259473'),
        //         ('418', 'USMAN', '628990621866'),
        //         ('416', 'SUYANTO', '6281397930405'),
        //         ('41', 'JOHANI', '62895357544883'),
        //         ('40', 'AHMAD YANI', '6282129023500'),
        //         ('374', 'TARMUJI', '6282302471659'),
        //         ('373', 'ABDULLAH', '6285748347854'),
        //         ('365', 'HARSONO', '6282337297379'),
        //         ('363', 'SUGIYANTO', '6281548641205'),
        //         ('362', 'JAENUDIN', '6287741051487'),
        //         ('356', 'MUSTAR', '6281296741500'),
        //         ('350', 'MARYANTO', '6281221407622'),
        //         ('349', 'SUPARMIN', '6289512090736'),
        //         ('346', 'SUDARNO', '6282114348572'),
        //         ('344', 'SANTOSO', '6281297847946'),
        //         ('342', 'MADRONI', '6282118789960'),
        //         ('333', 'TURMUDI', '6285313166318'),
        //         ('329', 'SUSANTO', '6282298965572'),
        //         ('321', 'SUPRAPTO', '6282111400120'),
        //         ('319', 'HENDARSO', '6282240460114'),
        //         ('318', 'SUNARJI', '6285331606286'),
        //         ('313', 'HASANUDIN', '6287719662028'),
        //         ('290', 'WAHYUDIN', '6285711210340'),
        //         ('289', 'KARNOTO', '6287724408681'),
        //         ('279', 'SYARIPUDIN', '6285759191939'),
        //         ('278', 'HENDRO', '6287779800684'),
        //         ('268', 'JAMAN', '6285880905979'),
        //         ('262', 'SUTARJO', '628999432224'),
        //         ('257', 'TARYADI', '6283861622417'),
        //         ('255', 'JUWADI', '6288294970184'),
        //         ('254', 'DARMIN', '6283865526287'),
        //         ('234', 'SUGANDI', '628121866987'),
        //         ('233', 'SAMHARI', '6283871913855'),
        //         ('230', 'KUSNADI', '6285887497595'),
        //         ('194', 'ULINHIDAYATULLAH', '6289520441481'),
        //         ('191', 'HARRYABDULAH', '6282124280196'),
        //         ('185', 'ARISSUTRISNO', '6285715979786'),
        //         ('171', 'TRIMANTO', '6285786425052'),
        //         ('170', 'SISWOKO', '6282183845230'),
        //         ('169', 'WAGIMAN', '6285313782397'),
        //         ('151', 'SUKENDAR', '628973832511'),
        //         ('143', 'VIKTORANTONIO', '6282317171701'),
        //         ('139', 'SUHENDAR', '6285694371557'),
        //         ('138', 'NATA', '6282310433255'),
        //         ('136', 'TEGUH', '6281220177160'),
        //         ('133', 'HERIYANTO', '6285324740376'),
        //         ('131', 'DEDI PURWANTO', '628156034900'),
        //         ('129', 'DARMA', '628710729880'),
        //         ('129', 'DARMA', '6281293395988'),
        //         ('128', 'DARSA HIDAYAT', '6287804095151'),
        //         ('127', 'ASMAN', '6281511910313'),
        //         ('123', 'YAYANG TRI YOMARTHA', '6282299116770'),
        //         ('120', 'RIZKY ALBAR', '6283117995248'),
        //         ('119', 'AHMAD SARIPUDIN', '6282177127500'),
        //         ('118', 'DEDE ANDRI IRAWAN', '6281212208384'),
        //         ('117', 'RONI SAPUTRA', '6287713226360'),
        //         ('108', 'CARMIN', '62895393557554'),
        //         ('106', 'ADAM GIBRAN', '6281224213934'),
        //         ('103', 'SUTODI', '6281572251685'),
        //         ('102', 'MALIK PAAT', '628978562496'),
        //         ('101', 'AKDI', '6282385194448'),
        //         ('100', 'DULHADI', '6282118111763');
        // ");
    }
}
