<?php

namespace App\Transformers;

use App\Models\Attachment;
use League\Fractal\TransformerAbstract;

class AttachmentTransformer extends TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param Attachment $attachment
     * @return array
     */
    public function transform(Attachment $attachment)
    {
        return [
            'id' => $attachment->id,
            'path' => $attachment->path,
            'attachment_url' => $attachment->attachment_url,
            'attachmentable_id' => $attachment->attachmentable_id,
            'attachmentable_type' => $attachment->attachmentable_type,
        ];
    }
}
