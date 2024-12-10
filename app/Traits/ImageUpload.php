<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

trait ImageUpload
{
    public function upload(string $property, string $model, string $path): void
    {
        // Jika user sudah upload gambar
        if ($this->$property instanceof TemporaryUploadedFile) {
            // Jika model sebelumnya sudah mempunyai gambar
            if ($this->$model->$property) {
                // maka hapus gambar lama mereka
                Storage::delete($this->$model->$property);
            }
            // ganti dengan gambar yang baru mereka upload
            $this->$property =  $this->$property->store(path: $path);
        } else {
            // Jika user tidak memilih gambar, maka gunakan gambar lama mereka
            $this->$property = $this->$model->$property;
        }
    }
}
