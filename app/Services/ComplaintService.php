<?php

namespace App\Services;

use App\Models\Complaint;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class ComplaintService
{
    public function createNewComplaint(array $biodata, array $complaintData, ?UploadedFile $attachment): Complaint
    {
        // Handle file upload
        if ($attachment) {
            $complaintData['attachment'] = $attachment->store('attachments', 'public');
        }

        // Gabungkan data
        $fullData = array_merge($biodata, $complaintData);

        // Buat Token Unik
        $fullData['token'] = Str::upper(Str::random(10));

        return Complaint::create($fullData);
    }
}
