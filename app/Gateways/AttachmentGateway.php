<?php

namespace App\Gateways;

use App\Models\Attachment;
use Illuminate\Http\UploadedFile;

class AttachmentGateway
{
    /**
     * Загружает приложение.
     *
     * @param UploadedFile $attachment
     * @param string $path
     * @return Attachment
     */
    public function create(UploadedFile $attachment, $path)
    {
        $path = $attachment->store($path);
        $attachment = new Attachment([
            'path' => $path
        ]);
        return $attachment;
    }

    /**
     * Загружает массив приложений.
     *
     * @param array $attachments
     * @param string $path
     * @return array
     */
    public function createAll(array $attachments, $path)
    {
        $collection = [];
        foreach($attachments as $attachment) {
            $collection[] = $this->create($attachment, $path);
        }
        return $collection;
    }
}