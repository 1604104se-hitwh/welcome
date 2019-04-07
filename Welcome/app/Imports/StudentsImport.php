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
         * @return Students|null
         */

        public function model(array $row)
        {
            return new Students([
                'stu_status' => 'PREPARE',
                'stu_degree' => 'UG',
                'stu_num' => $row['stuid'],
                'stu_name' => $row['name'],
                'stu_gen' => ($row['gender'] == '男') ? 0 : 1,
                'stu_cid' => $row['cid'],
                'stu_eid' => $row['eid'],
                'stu_dorm_str' => $row['dorm'],
                'stu_from_school' => $row['school'],
            ]);
        }

        public function headingRow(): int
        {
            return 2;
        }
    }
