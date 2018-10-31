<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class ProductsExp implements FromView, ShouldAutoSize, WithEvents
{
    use Exportable;
    static $exportType;
    public function __construct($exportType, $products)
    {
        $this->products = $products;
        self::$exportType = $exportType;
    }
    public static function getExportType()
    {
        return self::$exportType;
    }
    public function view(): View
    {
        $products = $this->products;
        return view('exports.products.index', compact('products'));
    }
     public function registerEvents(): array
    {
        return [
            AfterSheet::class => [self::class, 'afterSheet']
        ];
    }
    public static function afterSheet(AfterSheet $event)
    {

        $activeSheet    = $event->sheet->getDelegate();
        $maxCol         = $activeSheet->getHighestColumn();
        $maxRow         = $activeSheet->getHighestRow();
        $sheetDimension = 'A1:'.$maxCol.$maxRow;

        // IF PDF
        if(self::getExportType() == 'pdf'){
            $activeSheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            $activeSheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A3);
        }

        // SET ALIGN
        $activeSheet->getStyle( 'A1:'.$maxCol.'2' )->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $activeSheet->getStyle( 'A1:'.$maxCol.'2' )->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $activeSheet->getStyle( 'A3:'.$maxCol.$maxRow )->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
        $activeSheet->getStyle( 'A3:'.$maxCol.$maxRow )->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $activeSheet->getColumnDimension('C')->setAutoSize(false)->setWidth(50);;
        $activeSheet->getStyle( 'C1:C'.$maxRow )->getAlignment()->setWrapText(true);
        // SET BORDER
        $activeSheet->getStyle( 'A2:'.$maxCol.$maxRow )->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgba' => 'FFFF0000'],
                ],
            ]
        ]);
        // SET FONT
        $activeSheet->getStyle( 'A1:'.$maxCol.'1' )->getFont()->setSize(18);
        $activeSheet->getRowDimension('1')->setRowHeight(30);
        $activeSheet->getStyle( 'A2:'.$maxCol.'2' )->getFont()->setSize(12);
        $activeSheet->getRowDimension('2')->setRowHeight(20);

    }
}
