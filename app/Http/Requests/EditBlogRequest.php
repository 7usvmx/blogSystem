<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditBlogRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      "name" => "required|string",
      "image" => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
      "category_id" => "exists:categories,id",
      "description" => "required|string",
    ];
  }

  public function messages()
  {
    return [
      "name.required" => "Blog name is required",
      "image.required" => "Blog image is required",
      "category_id.required" => "Blog category is required",
      "description.required" => "Blog description is required",

      "name.string" => "Blog name must be a string",
      "image.image" => "Blog image must be an image",
      "category_id.exists" => "Blog category must exist",
      "description.string" => "Blog description must be a string",
    ];
  }
}
