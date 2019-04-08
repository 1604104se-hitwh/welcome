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
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // 先查询有没有同的数据
        if(!($row['dept'] && $row['majornum'] && $row['majorname'])){
            // 合规检查
            return ;
        }
        $deptID = Department::where('dept_name',$row['dept'])
            ->select('id')->first();
        if(!$deptID){
            $deptID = Department::create(['dept_name'=>$row['dept']]);
        }
        return new Major([
            'major_num' => $row['majornum'],
            'major_name' => $row['majorname'],
            'dept_id' => $deptID['id'],
        ]);
    }

    public function headingRow(): int
    {
        return 2;
    }
}
