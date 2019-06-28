<?php

    namespace App\Imports;

    use App\Models\Students as Students;
    use Maatwebsite\Excel\Concerns\ToModel;
    use Maatwebsite\Excel\Concerns\WithHeadingRow;

    class StudentsImport implements ToModel,WithHeadingRow
    {
        /**
         * @param array $row
         *
         * @throws \Exception
         * @return Students|null
         */

        public function model(array $row)
        {
            if( !(array_key_exists('stuid',$row) &&
                array_key_exists('name',$row) &&
                array_key_exists('gender',$row) &&
                array_key_exists('cid',$row) &&
                array_key_exists('eid',$row) &&
                array_key_exists('dorm',$row) &&
                array_key_exists('school',$row))){
                // 合规检查，检查1 开始有没有此行；检查2 后续会不会有没有的数据
                throw (new \Exception("This files is in incorrect styles!"));
            }elseif (empty($row['stuid']) || empty($row['name']) || empty($row['gender'])
                        || empty($row['stuid']) || empty($row['cid']) || empty($row['eid'] )
                        || empty($row['dorm']) || empty($row['school'])){
                return null;
            }
            return new Students([
                'stu_status' => 'PREPARE',
                'stu_degree' => 'UG',
                'stu_num' => trim($row['stuid']),
                'stu_name' => trim($row['name']),
                'stu_gen' => (trim($row['gender']) == '男') ? 0 : 1,
                'stu_cid' => trim($row['cid']),
                'stu_eid' => trim($row['eid']),
                'stu_dorm_str' => trim($row['dorm']),
                'stu_from_school' => trim($row['school']),
            ]);
        }

        public function headingRow(): int
        {
            return 2;
        }
    }
