<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubmissionList;
use Illuminate\Support\Facades\Hash;

class SubmissionSeeder extends Seeder
{
    public function run(): void
    {
        $submissionLists = [
            [
                'submission_name'   => 'Submission 51',
                'reason'            => 'Reason 51',
                'vehicle_id'        => '1',
                'status'            => 'approval',
                'note'              => 'Note 51',
                'start_date'        => '2023-01-01',
                'end_date'          => '2023-01-05',
                'approve_by'        => '1',
                'created_at'        => '2023-01-01',
                'updated_at'        => '2023-01-05',
            ],
            [
                'submission_name'   => 'Submission 51',
                'reason'            => 'Reason 51',
                'vehicle_id'        => '2',
                'status'            => 'rejected',
                'note'              => 'Note 51',
                'start_date'        => '2023-02-01',
                'end_date'          => '2023-02-05',
                'approve_by'        => '1',
                'created_at'        => '2023-02-01',
                'updated_at'        => '2023-02-05',
            ],
            [
                'submission_name'   => 'Submission 51',
                'reason'            => 'Reason 51',
                'vehicle_id'        => '2',
                'status'            => 'approval',
                'note'              => 'Note 51',
                'start_date'        => '2023-02-15',
                'end_date'          => '2023-02-20',
                'approve_by'        => '1',
                'created_at'        => '2023-02-15',
                'updated_at'        => '2023-02-15',
            ],
            [
                'submission_name'   => 'Submission 51',
                'reason'            => 'Reason 51',
                'vehicle_id'        => '2',
                'status'            => 'rejected',
                'note'              => 'Note 51',
                'start_date'        => '2023-04-01',
                'end_date'          => '2023-04-05',
                'approve_by'        => '1',
                'created_at'        => '2023-05-01',
                'updated_at'        => '2023-05-05',
            ],
        ];

        foreach ($submissionLists as $key => $submissionList) {
            SubmissionList::create($submissionList);
        }
    }
}