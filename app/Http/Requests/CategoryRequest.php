<?php

namespace App\Http\Requests;

use App\Models\Category;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // jadi di belakang layar, kode dibawah ini akan mendapatkan id dari category yang saat ini diupdate
        // $this mengacu pada class CategoryRequest yang berisi request yang dikirim oleh user
        // $this->route('category')->id ambil 1 baris data category yg dikirim melalui route model binding, lalu ambil isi dari field id nya  
        $id = $this->route('category')->id ?? null;

        return [
            'name' => 'required|unique:categories,name,' . $id,
            'slug' => 'alpha_dash',
        ];
    }

    public function updateOrInsert($category = null)
    {
        $this['slug'] = str()->slug($this->name);
        $category ? $category->update($this->all()) : Category::create($this->all());
    }
}