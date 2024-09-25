<?php

namespace App\Admin\Exports;

use Illuminate\Database\Eloquent\Builder;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * 导出excel
 */
class ExportXls
{
    /**
     * 实例
     */
    private $sp;

    /**
     * 活动文档
     */
    private $sheet;

    /**
     * 当前行数
     */
    private $row = 1;

    /**
     * 表头
     */
    private $headers;

    /**
     * 导出数据
     */
    protected $datas;

    /**
     * 从查询导出数据
     *
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $query;

    /**
     * 数据处理大小
     */
    public $size = 1000;

    /**
     * 额外参数
     */
    public $params = [];

    /**
     * 构造函数
     *
     * @param Builder|array $datas 数组或对象
     */
    public function __construct($datas, $headers = [], $params = [])
    {
        $this->headers = $headers;

        if ($datas instanceof Builder) {
            $this->query = $datas;
        } else {
            $this->datas = $datas;
        }

        $this->params = $params;
    }

    /**
     * 数组处理
     */
    public function array($datas = [])
    {
        foreach ($datas as $key => $data) {
            $this->push($this->map($data, $key));
        }
    }

    /**
     * 数据库查询
     */
    public function queryDB(Builder $query, $size = 1000)
    {
        $page = 1;
        $size = $size ?: $this->size;
        do {
            $datas = $query->skip(($page - 1) * $size)->take($size)->get();
            $this->array($datas);
            $page++;
        } while (count($datas) == $size);
    }

    /**
     * 写入数据
     */
    public function push($data)
    {
        $col = 'A';
        foreach ($data as $value) {
            $this->sheet->setCellValue($col . $this->row, $value);
            $col++;
        }
        $this->row++;
    }

    /**
     * 映射字段
     */
    public function map($data, $key = ''): array
    {
        return $data;
    }

    /**
     * 表头
     */
    public function headings(): array
    {
        return $this->headers;
    }

    /**
     * 表尾
     */
    public function footer(): array
    {
        return [];
    }

    /**
     * 下载文件
     */
    public function download(string $filename)
    {
        set_time_limit(3600);
        ini_set('max_execution_time', '3600');
        ini_set('memory_limit', '1024M');

        $this->sp = new Spreadsheet();
        $this->sheet = $this->sp->getActiveSheet();

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $this->push($this->headings());

        if ($this->datas) {
            $this->array($this->datas);
        }

        if ($this->query) {
            $this->queryDB($this->query);
        }

        $this->push($this->footer());
    }

    public function destroy()
    {
        $writer = new Xlsx($this->sp);
        $writer->save('php://output');
        $this->sp->disconnectWorksheets();
        exit;
    }

    public function __destruct()
    {
        $this->destroy();
    }
}
