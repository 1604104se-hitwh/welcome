<?php

namespace App\Imports;

use App\Models\Major;
use App\Models\Department;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MajorImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @throws \Exception
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // 先查询有没有同的数据
        if( !(array_key_exists('dept',$row) &&
            array_key_exists('majornum',$row) &&
            array_key_exists('majorname',$row))){
            // 合规检查，检查1 开始有没有此行；检查2 后续会不会有没有的数据
            throw (new \Exception("This files is in incorrect styles!"));
        }elseif (empty($row['dept'] || empty($row['majornum'] || empty($row['majorname'])))){
            return null;
        }
        $deptID = Department::where('dept_name',trim($row['dept']))
            ->select('id')->first();
        if(!$deptID){
            $deptID = Department::create(['dept_name'=>trim($row['dept'])]);
        }
        return new Major([
            'major_num' => trim($row['majornum']),
            'major_name' => trim($row['majorname']),
            'dept_id' => trim($deptID['id']),
        ]);
    }

    public function headingRow(): int
    {
        return 2;
    }
}
